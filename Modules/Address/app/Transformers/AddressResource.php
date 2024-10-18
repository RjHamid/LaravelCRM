<?php

namespace Modules\Address\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [  
            'id' => $this->id,  
            'user_id' => $this->user_id,  
            'description' => $this->description,  
            'created_at' => $this->created_at,  
            'updated_at' => $this->updated_at,  
        ]; 
    }
}