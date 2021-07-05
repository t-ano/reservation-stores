<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan;
use App\Http\Requests\PlanRequest;

class PlanController extends Controller
{
    public function index()
    {
        $plans = Plan::all();

        return view('plan.index', compact('plans'));
    }

    public function create()
    {
        return view('plan.create');
    }

    public function store(PlanRequest $request)
    {
        Plan::insert([
            'name' => $request->name,
            'price' => (int)$request->price
        ]);

        $plans = Plan::all();

        return redirect()->route('plan.index', ['plans' => $plans]);
    }

    public function edit($id)
    {
        $plan = Plan::findOrFail($id);

        return view('plan.edit', compact('plan'));
    }


    public function update(PlanRequest $request, $id)
    {
        Plan::where('id', $id)->update([
            'name' => $request->name, 
            'price' => $request->price
        ]);

        $plans = Plan::all();

        return redirect()->route('plan.index', ['plans' => $plans]);
    }

    public function destroy($id)
    {
        Plan::where('id', $id)->delete();

        $plans = Plan::all();

        return redirect()->route('plan.index', ['plans' => $plans]);
    }

}
