<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController
{
    public function create(Request $request){

        $payment=Payment::create($request->toArray());

        return response()->json($payment);
    }
    public function index($id = null)
    {
        if ($id) {
            $payment = Payment::where('id', $id)->first();
        } else {
            $payment = Payment::get();
        }

        return response()->json($payment);
    }

    public function edit(Request $request, $id)
    {
        $payment = Payment::where('id', $id)
            ->update($request->toArray());

        return response()->json($payment);
    }

    public function delete($id)
    {
        Payment::where('id', $id)->delete();

        return response()->json('payment deleted successfully!');
    }
}
