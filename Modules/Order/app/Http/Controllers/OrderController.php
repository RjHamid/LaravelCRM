<?php

namespace Modules\Order\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id = null)
    {
        if ($id) {
            $order = Order::where('id', $id)->first();
        } else {
            $order = Order::get();
        }

        return response()->json($order);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request){

        $order=Order::create($request->toArray());

        return response()->json($order);
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     //
    // }

    /**
     * Show the specified resource.
     */
    // public function show($id)
    // {
    //     return view('order::show');
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id)
    {
        $order = Order::where('id', $id)
            ->update($request->toArray());

        return response()->json($order);
    }


    /**
     * Update the specified resource in storage.
     */
    public function delete($id)
    {
        Order::where('id', $id)->delete();

        return response()->json('order deleted successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy($id)
    // {
    //     //
    // }
}
