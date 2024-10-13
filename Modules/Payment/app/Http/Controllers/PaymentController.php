<?php

namespace Modules\Payment\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Payment\Http\Requests\StorePaymentRequest;
use Modules\Payment\Http\Requests\UpdatePaymentRequest;
use Modules\Payment\Models\Payment;
use Modules\Payment\Transformers\PaymentResource;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id = null)  
    {  
        if ($id) {  
            // پیدا کردن یک کارت خاص با ID مشخص  
            $payment = Payment::find($id);  
    
            // بررسی وجود رکورد  
            if (!$payment) {  
                return response()->json(['message' => 'payment not found'], 404);  
            }  
    
            // بازگشت تنها رکورد  
            return response()->json(new PaymentResource($payment));  
        } else {  
            // بازگشت تمام رکوردها  
            $payment = Payment::all();  
    
            // بازگشت مجموعه رکوردها  
            return response()->json(PaymentResource::collection($payment));  
        }  
    } 

    /**
     * Show the form for creating a new resource.
     */
    public function create(StorePaymentRequest $request){

        $payment=Payment::create($request->toArray());

        return response()->json(new PaymentResource($payment));
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
    //     return view('payment::show');
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UpdatePaymentRequest $request, $id)  
    {  
        // پیدا کردن رکورد  
        $payment = Payment::find($id);  
    
        // بررسی وجود رکورد  
        if (!$payment) {  
            return response()->json(['message' => 'payment not found'], 404);  
        }  
    
        // بروزرسانی رکورد  
        $payment->update($request->toArray());  
    
        // بازگشت به روز رسانی شده  
        return response()->json(new PaymentResource($payment));  
    }


    /**
     * Update the specified resource in storage.
     */
    public function delete($id)
    {
        Payment::where('id', $id)->delete();

        return response()->json('payment deleted successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy($id)
    // {
    //     //
    // }
}
