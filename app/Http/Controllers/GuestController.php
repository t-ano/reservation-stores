<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Plan;

class GuestController extends Controller
{

    public function index(Request $request) {
        $word = '';
        $month = '';

        if ($request->shop) {
            $shops = Shop::where('name', 'like', "%{$request->shop}%")->get();
            $word = $request->shop;
        } else {
            $shops = Shop::all();
        }

        if ($request->month) {
            $month = $request->month;
            $m = date('m', strtotime($request->month));
            $plans = Plan::whereMonth('start', $m)->get();
        } else {
            $plans = Plan::all();
        }
        
        return view('guest.index', compact('shops', 'plans', 'word', 'month'));
    }

    public function create(Request $request) {
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

    public function store(Request $request) {

    }
}
