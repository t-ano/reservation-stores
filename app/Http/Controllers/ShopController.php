<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;

class ShopController extends Controller
{

    public function index() {
        $shops = Shop::all();

        return view('shop.index', compact('shops'));
    }

    public function create() {
        return view('shop.create');
    }

    public function edit() {
        return view('shop.edit');
    }

}
