<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Http\Requests\ShopRequest;

class ShopController extends Controller
{

    public function index()
    {
        $shops = Shop::all();

        return view('shop.index', compact('shops'));
    }

    public function create()
    {
        return view('shop.create');
    }

    public function store(ShopRequest $request)
    {
        Shop::insert([
            'name' => $request->name
        ]);

        $shops = Shop::all();

        return redirect()->route('shop.index', ['shops' => $shops]);
    }

    public function edit($id)
    {
        $shop = Shop::findOrFail($id);

        return view('shop.edit', compact('shop'));
    }


    public function update(ShopRequest $request, $id)
    {
        Shop::where('id', $id)->update(['name' => $request->name]);

        $shops = Shop::all();

        return redirect()->route('shop.index', ['shops' => $shops]);
    }

    public function destroy($id)
    {
        Shop::where('id', $id)->delete();

        $shops = Shop::all();

        return redirect()->route('shop.index', ['shops' => $shops]);
    }

}
