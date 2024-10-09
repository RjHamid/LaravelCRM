<?php

namespace Modules\Payment\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id = null)
    {
        if ($id) {
            $payment = Payment::where('id', $id)->first();
        } else {
            $payment = Payment::get();
        }

        return response()->json($payment);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request){

        $payment=Payment::create($request->toArray());

        return response()->json($payment);
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
    public function edit(Request $request, $id)
    {
        $payment = Payment::where('id', $id)
            ->update($request->toArray());

        return response()->json($payment);
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
