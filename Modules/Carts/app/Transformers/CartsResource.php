<?php

namespace Modules\Carts\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [  
            'id' => $this->id,  
            'user_id' => $this->user_id,  
            'product_id' => $this->product_id,  
            'unique_code' => $this->unique_code,  
            'count' => $this->count,  
            'price_unit' => $this->price_unit,  
            'status' => $this->status,  
            'created_at' => $this->created_at,  
            'updated_at' => $this->updated_at,  
        ]; 
    }
}
