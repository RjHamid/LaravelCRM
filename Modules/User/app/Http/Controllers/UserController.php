<?php

namespace Modules\User\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Modules\User\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request,$id = null)
 {
        if ($id) {
            $User = User::where('id', $id)->first();
        } else {
            $User = User::paginate(10);
        }
        return response()->json($User);
    
}

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     return view('user::create');
    // }

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
    //     return view('user::show');
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request,$id)
    {
        $User = User::where('id', $id)->first();
        if (!$User) {
            return response()->json('User not found!');
        } else {
            $User->update($request
                ->merge(["Password" => Hash::make($request->Password)])
                ->toArray());
        }
        return response()->json('User edited successfully!');
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
    public function delete(Request $request,$id)
    {
        $User = User::where('id', $request->id)->first();
        if ($User) {
            $User->delete();
            return response()->json('User deleted successfully!');
        } else {
            return response()->json('User not found!');
        }
    }
}
