<?php

namespace App\Http\Controllers;

use App\Http\Resources\RatingResource;
use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController
{
    public function create(Request $request){

        $rating=Rating::create($request->toArray());

        return response()->json(new RatingResource ($rating),201);
    }
    public function index($id = null)
    {
        if ($id) {
            $rating = Rating::where('id', $id)->first();
            return response()->json(new RatingResource($rating));
        } else {
            $rating = Rating::get();
            return new RatingController($rating);
        }
    }

    public function edit(Request $request, $id)
    {
        $rating = Rating::where('id', $id)
            ->update($request->toArray());

        return response()->json(new RatingResource ($rating));
    }

    public function delete($id)
    {
        Rating::where('id', $id)->delete();

        return response()->json('rating deleted successfully!');
    }
}
