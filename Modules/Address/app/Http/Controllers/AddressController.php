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
    public function index($user_id ='user_id')  
    {  
        if ($user_id) {  
            
            $Address = Address::find($user_id);  
    
           
            if (!$Address) {  
                return response()->json(['message' => 'Address not found'], 404);  
            }  
    
            
            return response()->json($Address);  
        } else {  
             
            $Address = Address::all();  
    
            
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
        
        $Address = Address::find($id);  
    
       
        if (!$Address) {  
            return response()->json(['message' => 'Address not found'], 404);  
        }  
    
        
        $Address->update($request->toArray());  
    
       
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
