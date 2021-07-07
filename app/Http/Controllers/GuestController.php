<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Plan;
use App\Models\Reserve;
use App\Models\Customer;

class GuestController extends Controller
{

    public function index(Request $request)
    {
        if (isset($_GET['search'])) {
            session()->forget(['word', 'month']);
            session(['word' => $request->word]);
            session(['month' => $request->month]);
        }
        $word = session('word', '');
        $month = session('month', '');

        if ($word) {
            $shops = Shop::where('name', 'like', "%{$word}%")->get();
        } else {
            $shops = Shop::all();
        }

        if ($month) {
            $m = date('m', strtotime($month));
            $plans = Plan::whereMonth('start', $m)->get();
        } else {
            $plans = Plan::all();
        }

        $selectedShop = (isset($request->selectedShop)) ? $request->selectedShop : '';
        $selectedPlan = (isset($request->selectedPlan)) ? $request->selectedPlan : '';

        return view('guest.index', compact('shops', 'plans', 'word', 'month', 'selectedShop', 'selectedPlan'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'shop' => 'required',
            'plan' => 'required'
        ], [
            'shop.required' => '店舗を選んでください。',
            'plan.required' => 'プランを選んでください。'
        ]);

        $shop = Shop::findOrFail($request->shop);
        $plan = Plan::findOrFail($request->plan);

        return view('guest.create', compact('shop', 'plan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mail' => 'email:rfc'
        ], [
            'mail.email' => 'メールアドレスを正しく入力してください。'
        ]);

        $c_id = Customer::insertGetId([
            'name' => $request->name,
            'mail' => $request->mail
        ]);
        $r_id = Reserve::insertGetId([
            'customer' => $c_id,
            'shop' => $request->shop,
            'plan' => $request->plan
        ]);

        // $c_id = 2;
        // $r_id = 1;
        return redirect()->route('guest.show', ['c_id' => $c_id, 'r_id' => $r_id]);
    }

    public function show($c_id, $r_id)
    {
        $customer = Customer::findOrFail($c_id);

        $reserve = Reserve::where('reserves.id', '=', $r_id)
            ->select('price', 'shops.name as s_name', 'plans.name as p_name')
            ->join('shops', 'reserves.shop', '=', 'shops.id')
            ->join('plans', 'reserves.shop', '=', 'plans.id')
            ->get()[0];

        return view('guest.show', compact('customer', 'reserve'));
    }

    public function pay()
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        function calculateOrderAmount(array $items): int
        {
            // Replace this constant with a calculation of the order's amount
            // Calculate the order total on the server to prevent
            // customers from directly manipulating the amount on the client
            return 1400;
        }

        header('Content-Type: application/json');

        try {
            // retrieve JSON from POST body
            $json_str = file_get_contents('php://input');
            $json_obj = json_decode($json_str);

            $paymentIntent = \Stripe\PaymentIntent::create([
                'amount' => calculateOrderAmount($json_obj->items),
                'currency' => 'usd',
            ]);

            $output = [
                'clientSecret' => $paymentIntent->client_secret,
            ];

            echo json_encode($output);
        } catch (Error $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
}
