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
            $cart = Carts::where('id', $id)->first();

            return response()->json(new CartResource ($cart));
        } else {
            $cart = Carts::get();

            return response()->json(new CartCollection($cart));
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
        $cart = Carts::where('id', $id)
            ->update($request->toArray());

        return response()->json(new CartResource($cart));
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
