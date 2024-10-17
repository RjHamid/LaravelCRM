<?php

namespace Modules\Address\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Address\Models\Address;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id = null)  
    {  
        if ($id) {  
            // پیدا کردن یک کارت خاص با ID مشخص  
            $Address = Address::find($id);  
    
            // بررسی وجود رکورد  
            if (!$Address) {  
                return response()->json(['message' => 'Address not found'], 404);  
            }  
    
            // بازگشت تنها رکورد  
            return response()->json($Address);  
        } else {  
            // بازگشت تمام رکوردها  
            $Address = Address::all();  
    
            // بازگشت مجموعه رکوردها  
            return response()->json($Address);  
        }  
    } 

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request){

        $Address=Address::create($request->toArray());

        return response()->json($Address);
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
    //     return view('address::show');
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id)  
    {  
        // پیدا کردن رکورد  
        $Address = Address::find($id);  
    
        // بررسی وجود رکورد  
        if (!$Address) {  
            return response()->json(['message' => 'Address not found'], 404);  
        }  
    
        // بروزرسانی رکورد  
        $Address->update($request->toArray());  
    
        // بازگشت به روز رسانی شده  
        return response()->json($Address);  
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
        Address::where('id', $id)->delete();

        return response()->json('Address deleted successfully!');
    }
    public function indexA(){}
}
