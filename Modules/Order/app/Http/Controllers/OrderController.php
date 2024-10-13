<?php

namespace Modules\Order\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Order\Http\Requests\StoreOrderRequest as RequestsStoreOrderRequest;
use Modules\Order\Http\Requests\UpdateOrderRequest as RequestsUpdateOrderRequest;
use Modules\Order\Models\Order as ModelsOrder;
use Modules\Order\Transformers\OrderResource as TransformersOrderResource;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id = null)  
    {  
        if ($id) {  
            // پیدا کردن یک کارت خاص با ID مشخص  
            $order = ModelsOrder::find($id);  
    
            // بررسی وجود رکورد  
            if (!$order) {  
                return response()->json(['message' => 'Order not found'], 404);  
            }  
    
            // بازگشت تنها رکورد  
            return response()->json(new TransformersOrderResource($order));  
        } else {  
            // بازگشت تمام رکوردها  
            $orders = ModelsOrder::all();  
    
            // بازگشت مجموعه رکوردها  
            return response()->json(TransformersOrderResource::collection($orders));  
        }  
    } 


    /**
     * Show the form for creating a new resource.
     */
    public function create(RequestsStoreOrderRequest $request){

        $order=ModelsOrder::create($request->toArray());

        return response()->json(new TransformersOrderResource($order));
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
    public function edit(RequestsUpdateOrderRequest $request, $id)  
    {  
        // پیدا کردن رکورد  
        $order = ModelsOrder::find($id);  
    
        // بررسی وجود رکورد  
        if (!$order) {  
            return response()->json(['message' => 'Order not found'], 404);  
        }  
    
        // بروزرسانی رکورد  
        $order->update($request->toArray());  
    
        // بازگشت به روز رسانی شده  
        return response()->json(new TransformersOrderResource($order));  
    }


    /**
     * Update the specified resource in storage.
     */
    public function delete($id)
    {
        ModelsOrder::where('id', $id)->delete();

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
