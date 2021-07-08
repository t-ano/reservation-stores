<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Symfony\Component\HttpFoundation\StreamedResponse;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::select('name', 'mail', 'customers.id as c_id')
            ->join('reserves', 'reserves.customer', '=', 'customers.id')
            ->get();

        return view('customer.index', compact('customers'));
    }

    public function show($id)
    {
        $reserves = Customer::where('customers.id', '=', $id)
            ->select('customers.name as c_name', 'customers.mail as c_mail', 'price', 'shops.name as s_name', 'plans.name as p_name', 'reserves.datetime as r_dt', 'reserves.payment')
            ->join('reserves', 'reserves.customer', '=', 'customers.id')
            ->join('shops', 'reserves.shop', '=', 'shops.id')
            ->join('plans', 'reserves.plan', '=', 'plans.id')
            ->get();

        return view('customer.show', compact('reserves'));
    }

    public function download()
    {
        $customers = Customer::select('name', 'mail', 'customers.id as c_id')
            ->join('reserves', 'reserves.customer', '=', 'customers.id')
            ->get();

        $cvsList[] = array('名前', 'メールアドレス');
        if ($customers) {
            foreach ($customers as $customer) {
                $cvsList[] = array(
                    $customer->name,
                    $customer->mail
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
        $response->headers->set('Content-Disposition', 'attachment; filename="customers.csv"');
 
        return $response;
    }
}
