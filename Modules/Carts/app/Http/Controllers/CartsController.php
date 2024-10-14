<?php

namespace Modules\Carts\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Http\Resources\CartCollection;
use App\Http\Resources\CartResource;
use App\Models\Carts;
use Illuminate\Http\Request;
use Modules\Carts\Http\Requests\StoreCartRequest as RequestsStoreCartRequest;
use Modules\Carts\Http\Requests\UpdateCartRequest as RequestsUpdateCartRequest;
use Modules\Carts\Models\Carts as ModelsCarts;
use Modules\Carts\Transformers\CartsResource;

class CartsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id = null)  
    {  
        if ($id) {  
            // پیدا کردن یک کارت خاص با ID مشخص  
            $cart = ModelsCarts::find($id);  
    
            // بررسی وجود رکورد  
            if (!$cart) {  
                return response()->json(['message' => 'Cart not found'], 404);  
            }  
    
            // بازگشت تنها رکورد  
            return response()->json(new CartsResource($cart));  
        } else {  
            // بازگشت تمام رکوردها  
            $carts = ModelsCarts::all();  
    
            // بازگشت مجموعه رکوردها  
            return response()->json(CartsResource::collection($carts));  
        }  
    } 

    /**
     * Show the form for creating a new resource.
     */
    public function create(RequestsStoreCartRequest $request){

        $uniqueCode = rand(1000, 9999);  

       
        $cart = ModelsCarts::create([  
            'user_id' => $request->user_id,  
            'product_id' => $request->product_id,  
            'unique_code' => $uniqueCode,  
            'count' => $request->count,  
            'price_unit' => $request->price_unit,  
            'status' => $request->status,  
        ]);  

        return response()->json([  
            'message' => 'سبد خرید با موفقیت ایجاد شد.',  
            'cart' => $cart,  
        ], 201);  
    
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
    //     return view('carts::show');
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RequestsUpdateCartRequest $request, $id)  
    {  
        // پیدا کردن رکورد  
        $order = ModelsCarts::find($id);  
    
        // بررسی وجود رکورد  
        if (!$order) {  
            return response()->json(['message' => 'Order not found'], 404);  
        }  
    
        // بروزرسانی رکورد  
        $order->update($request->toArray());  
    
        // بازگشت به روز رسانی شده  
        return response()->json(new CartsResource($order));  
    }

    /**
     * Update the specified resource in storage.
     */
    public function delete($id)
    {
        ModelsCarts::where('id', $id)->delete();

        return response()->json('cart deleted successfully!');
    }
    public function indexn($userId)  
{  
    $carts = ModelsCarts::where('user_id', $userId)->get();

    return response()->json($carts);  
} 
public function indexz($userId, $status)  
{  
    $carts = ModelsCarts::where('user_id', $userId)  
                 ->where('status', $status)  
                 ->get();  
    return response()->json($carts);  
}
    /**
     * Remove the specified resource from storage.
     */
    // public function destroy($id)
    // {
    //     //
    // }
}
