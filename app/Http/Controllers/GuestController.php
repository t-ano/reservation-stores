<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Plan;

class GuestController extends Controller
{

    public function index() {

        $shops = Shop::all();

        return view('guest.index', compact('shops'));
    }
}
