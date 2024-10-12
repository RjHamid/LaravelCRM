<?php

namespace Modules\Carts\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\CartCollection;
use App\Http\Resources\CartResource;
use App\Models\Carts;
use Illuminate\Http\Request;

class CartsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id = null)  
    {  
        if ($id) {  
            // پیدا کردن یک کارت خاص با ID مشخص  
            $cart = Carts::find($id);  
    
            // بررسی وجود رکورد  
            if (!$cart) {  
                return response()->json(['message' => 'Cart not found'], 404);  
            }  
    
            // بازگشت تنها رکورد  
            return response()->json(new CartResource($cart));  
        } else {  
            // بازگشت تمام رکوردها  
            $carts = Carts::all();  
    
            // بازگشت مجموعه رکوردها  
            return response()->json(CartResource::collection($carts));  
        }  
    } 

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request){

        $cart=Carts::create($request->toArray());

        return response()->json(new CartResource($cart));
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
    public function edit(Request $request, $id)  
    {  
        // پیدا کردن رکورد  
        $order = Carts::find($id);  
    
        // بررسی وجود رکورد  
        if (!$order) {  
            return response()->json(['message' => 'Order not found'], 404);  
        }  
    
        // بروزرسانی رکورد  
        $order->update($request->toArray());  
    
        // بازگشت به روز رسانی شده  
        return response()->json(new CartResource($order));  
    }

    /**
     * Update the specified resource in storage.
     */
    public function delete($id)
    {
        Carts::where('id', $id)->delete();

        return response()->json('cart deleted successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy($id)
    // {
    //     //
    // }
}
