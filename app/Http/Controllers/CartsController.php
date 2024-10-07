<?php

namespace App\Http\Controllers;

use App\Models\Carts;
use Illuminate\Http\Request;

class CartsController
{
    public function create(Request $request){

        $cart=Carts::create($request->toArray());

        return response()->json($cart);
    }
    public function index($id = null)
    {
        if ($id) {
            $cart = Carts::where('id', $id)->first();
        } else {
            $cart = Carts::get();
        }

        return response()->json($cart);
    }

    public function edit(Request $request, $id)
    {
        $cart = Carts::where('id', $id)
            ->update($request->toArray());

        return response()->json($cart);
    }

    public function delete($id)
    {
        Carts::where('id', $id)->delete();

        return response()->json('cart deleted successfully!');
    }
}
