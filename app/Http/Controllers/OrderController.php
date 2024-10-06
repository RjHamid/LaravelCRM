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
}