<?php

namespace Modules\Sms\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Sms\Models\Sms;

class SmsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id = null)  
    {  
        if ($id) {  
            // پیدا کردن یک کارت خاص با ID مشخص  
            $Sms = Sms::find($id);  
    
            // بررسی وجود رکورد  
            if (!$Sms) {  
                return response()->json(['message' => 'Sms not found'], 404);  
            }  
    
            // بازگشت تنها رکورد  
            return response()->json($Sms);  
        } else {  
            // بازگشت تمام رکوردها  
            $Sms = Sms::all();  
    
            // بازگشت مجموعه رکوردها  
            return response()->json($Sms);  
        }  
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request){

        $Sms=Sms::create($request->toArray());

        return response()->json($Sms);
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
    //     return view('sms::show');
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id)  
    {  
        // پیدا کردن رکورد  
        $Sms = Sms::find($id);  
    
        // بررسی وجود رکورد  
        if (!$Sms) {  
            return response()->json(['message' => 'Sms not found'], 404);  
        }  
    
        // بروزرسانی رکورد  
        $Sms->update($request->toArray());  
    
        // بازگشت به روز رسانی شده  
        return response()->json($Sms);  
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, $id)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        Sms::where('id', $id)->delete();

        return response()->json('Sms deleted successfully!');
    }
}
