<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRatingRequest;
use App\Http\Requests\UpdateRatingRequest;
use App\Http\Resources\RatingResource;
use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController
{
    public function create(StoreRatingRequest $request){

        $rating=Rating::create($request->toArray());

        return response()->json(new RatingResource ($rating),201);
    }
    public function index($id = null)  
    {  
        if ($id) {  
             
            $rating = Rating::find($id);  
    
             
            if (!$rating) {  
                return response()->json(['message' => 'rating not found'], 404);  
            }  
    
            
            return response()->json(new RatingResource($rating));  
        } else {  
            
            $rating = Rating::all();  
    
            
            return response()->json(RatingResource::collection($rating));  
        }  
    } 

    public function edit(UpdateRatingRequest $request, $id)  
    {  
        // پیدا کردن رکورد  
        $rating = Rating::find($id);  
    
        // بررسی وجود رکورد  
        if (!$rating) {  
            return response()->json(['message' => 'rating not found'], 404);  
        }  
    
        // بروزرسانی رکورد  
        $rating->update($request->toArray());  
    
        // بازگشت به روز رسانی شده  
        return response()->json(new RatingResource($rating));  
    }

    public function delete($id)
    {
        Rating::where('id', $id)->delete();

        return response()->json('rating deleted successfully!');
    }
}
