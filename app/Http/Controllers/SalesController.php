<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reserve;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{
    public function index() {
        $reserves = Reserve::select('price', 'shops.name as s_name', 'plans.name as p_name', 'reserves.datetime as r_dt', 'reserves.payment')
            ->join('shops', 'reserves.shop', '=', 'shops.id')
            ->join('plans', 'reserves.plan', '=', 'plans.id')
            ->where('reserves.payment', '=' , true)
            ->orderBy('r_dt', 'desc')
            ->get();

        $result = Reserve::selectRaw('SUM(price) as total')
            ->join('plans', 'reserves.plan', '=', 'plans.id')
            ->where('reserves.payment', '=' , true)
            ->get()[0];

        return view('sales.index', compact('reserves', 'result'));
    }

    public function change(Request $request) {
        
        session()->forget(['date', 'month', 'year']);
        $target_date = ($request->date) ? $request->date : '';
        $target_month = ($request->month) ? $request->month : '';
        $target_year = ($request->year) ? $request->year : '';
        session([
            'date' => $target_date,
            'month' => $target_month,
            'year' => $target_year
        ]);

        $reserves = Reserve::select('price', 'shops.name as s_name', 'plans.name as p_name', 'reserves.datetime as r_dt', 'reserves.payment')
            ->join('shops', 'reserves.shop', '=', 'shops.id')
            ->join('plans', 'reserves.plan', '=', 'plans.id')
            ->where('reserves.payment', '=' , true);
        $result = Reserve::select(DB::Raw('SUM(price) as total'), 'reserves.datetime as r_dt')
            ->join('plans', 'reserves.plan', '=', 'plans.id')
            ->where('reserves.payment', '=' , true);
        if ($target_date) {
            $reserves = $reserves->whereDate('r_dt', $target_date);
            $result = $result->whereDate('r_dt', $target_date);
        } elseif ($target_month) {
            $month = date('m', strtotime($target_month));
            $reserves = $reserves->whereMonth('r_dt', $month);
            $result = $result->whereMonth('r_dt', $month);
        } elseif ($target_year) {
            $reserves = $reserves->whereYear('r_dt', $target_year);
            $result = $result->whereYear('r_dt', $target_year);
        } else {
            return redirect()->route('sales.index');
        }
        $reserves = $reserves->orderBy('r_dt', 'desc')->get();
        $result = $result->get()[0];
        
        return view('sales.index', compact('reserves', 'result'));
    }

    public function download()
    {
        $reserves = Reserve::select('price', 'shops.name as s_name', 'plans.name as p_name', 'reserves.datetime as r_dt', 'reserves.payment')
            ->join('shops', 'reserves.shop', '=', 'shops.id')
            ->join('plans', 'reserves.plan', '=', 'plans.id')
            ->where('reserves.payment', '=' , true)
            ->orderBy('r_dt', 'desc')
            ->get();

        $cvsList[] = array('売上日', '予約店舗', '予約プラン');
        if ($reserves) {
            foreach ($reserves as $reserve) {
                $cvsList[] = array(
                    str_replace('-', '/', $reserve->r_dt),
                    $reserve->s_name,
                    $reserve->p_name
                ); 
            }
        }
        $response = new StreamedResponse (function() use ($cvsList){
            $stream = fopen('php://output', 'w');
            stream_filter_prepend($stream,'convert.iconv.utf-8/cp932//TRANSLIT');  //　文字化け回避
            foreach($cvsList as $value) {
                fputcsv($stream, $value);
            }
            fclose($stream);
        });
        $response->headers->set('Content-Type', 'application/octet-stream');
        $response->headers->set('Content-Disposition', 'attachment; filename="sales.csv"');
 
        return $response;
    }

}
