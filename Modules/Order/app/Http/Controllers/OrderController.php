<?php

namespace Modules\Order\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderCollection;
use App\Http\Resources\OrderResource;
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

            return response()->json(new OrderResource($order));
        } else {
            $order = Order::get();

            return response()->json(new OrderCollection($order));
        }
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request){

        $order=Order::create($request->toArray());

        return response()->json(new OrderResource($order));
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

        return response()->json(new OrderResource($order));
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
