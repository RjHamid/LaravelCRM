<?php

namespace Modules\User\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\User\Http\Requests\CreateAddressRequest;
use Modules\User\Http\Requests\EditAddressRequest;
use Modules\User\Models\Address;
use Modules\User\Models\User;
use Modules\User\Transformers\AddressResource;
use Modules\User\Transformers\UserResource;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($user_id ='user_id')  
    {  
      $user =   User::find($user_id);
        if (!empty($user)) {  
            if ($user->addresses()->count() > 0) {  
                return response()->json(['data' => [
                    'user' => new UserResource($user),
                    'addresses' =>  AddressResource::collection($user->addresses)
                ]]); 
            }
            else{
                return response()->json(['message' => 'Address not found'], 404);  

            }  

          
        }   
    } 

    /**
     * Show the form for creating a new resource.
     */
    public function create(CreateAddressRequest $request){

        $Address=Address::create($request->toArray());

        return response()->json(new AddressResource($Address));
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
    public function edit(EditAddressRequest $request, $id)  
    {  
        
        $Address = Address::find($id);  
    
       
        if (!$Address) {  
            return response()->json(['message' => 'Address not found'], 404);  
        }  
    
        
        $Address->update($request->toArray());  
    
       
        return response()->json(new AddressResource($Address));  
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
