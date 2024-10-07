<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController
{
    public function create(Request $request){

        $order=Order::create($request->toArray());

        return response()->json($order);
    }
    public function index($id = null)
    {
        if ($id) {
            $order = Order::where('id', $id)->first();
        } else {
            $order = Order::get();
        }

        return response()->json($order);
    }

    public function edit(Request $request, $id)
    {
        $order = Order::where('id', $id)
            ->update($request->toArray());

        return response()->json($order);
    }

    public function delete($id)
    {
        Order::where('id', $id)->delete();

        return response()->json('order deleted successfully!');
    }
}

