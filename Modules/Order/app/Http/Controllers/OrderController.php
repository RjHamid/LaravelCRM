<?php

namespace Modules\Order\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
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
            // پیدا کردن یک کارت خاص با ID مشخص  
            $order = Order::find($id);  
    
            // بررسی وجود رکورد  
            if (!$order) {  
                return response()->json(['message' => 'Order not found'], 404);  
            }  
    
            // بازگشت تنها رکورد  
            return response()->json(new OrderResource($order));  
        } else {  
            // بازگشت تمام رکوردها  
            $orders = Order::all();  
    
            // بازگشت مجموعه رکوردها  
            return response()->json(OrderResource::collection($orders));  
        }  
    } 


    /**
     * Show the form for creating a new resource.
     */
    public function create(StoreOrderRequest $request){

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
    public function edit(UpdateOrderRequest $request, $id)  
    {  
        // پیدا کردن رکورد  
        $order = Order::find($id);  
    
        // بررسی وجود رکورد  
        if (!$order) {  
            return response()->json(['message' => 'Order not found'], 404);  
        }  
    
        // بروزرسانی رکورد  
        $order->update($request->toArray());  
    
        // بازگشت به روز رسانی شده  
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
