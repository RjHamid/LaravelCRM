<?php

namespace Modules\Order\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\order_product;
use Modules\Order\Http\Requests\StoreOrderRequest as RequestsStoreOrderRequest;
use Modules\Order\Http\Requests\UpdateOrderRequest as RequestsUpdateOrderRequest;
use Modules\Order\Models\Order as ModelsOrder;
use Modules\Carts\Models\Carts as ModelsCarts;
use Modules\Order\Transformers\OrderResource as TransformersOrderResource;
use Modules\ProductSuiteManager\Models\Product;

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
        $priceTotal = 0;  

        foreach ($request->products as $productData) {  
            $product = Product::find($productData['product_id']);  
            $priceTotal += $product->price * $productData['quantity'];  
        }  

        // ایجاد سفارش  
        $order = ModelsOrder::create([  
            'unique_code' => $request->unique_code,  
            'address_id' => $request->address_id,  
            'gate' => $request->gate,  
            'price_total' => $priceTotal,  
            'transaction_id' => null, 
            'status' => 'pending',  
        ]);  

        return response()->json(['order' => $order], 201);
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
         
        $order = ModelsOrder::find($id);  
         
        if (!$order) {  
            return response()->json(['message' => 'Order not found'], 404);  
        }  
    
        $order->update($request->toArray());  
    
        return response()->json(new TransformersOrderResource($order));  
    }


    /**
     * Update the specified resource in storage.
     */
    public function indexn($uniqueCode)  
    {  
         
        $cart = ModelsCarts::where('unique_code', $uniqueCode)->first();  
    
        if (!$cart) {  
            return response()->json([  
                'message' => 'سبد خرید با این کد یکتا پیدا نشد.',  
            ], 404);  
        }  
    
        
        $order = ModelsOrder::where('unique_code', $uniqueCode)->first();  
    
        if (!$order) {  
            return response()->json([  
                'message' => 'سفارش مرتبط با این سبد خرید پیدا نشد.',  
            ], 404);  
        }  
    
        return response()->json([  
            'order' => $order,  
        ], 200);  
    }
    /**
     * Remove the specified resource from storage.
     */
    // public function destroy($id)
    // {
    //     //
    // }
}
