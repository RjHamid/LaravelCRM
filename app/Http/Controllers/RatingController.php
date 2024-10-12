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
            // پیدا کردن یک کارت خاص با ID مشخص  
            $rating = Rating::find($id);  
    
            // بررسی وجود رکورد  
            if (!$rating) {  
                return response()->json(['message' => 'rating not found'], 404);  
            }  
    
            // بازگشت تنها رکورد  
            return response()->json(new RatingResource($rating));  
        } else {  
            // بازگشت تمام رکوردها  
            $rating = Rating::all();  
    
            // بازگشت مجموعه رکوردها  
            return response()->json(RatingResource::collection($rating));  
        }  
    } 

    public function edit(Request $request, $id)  
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
