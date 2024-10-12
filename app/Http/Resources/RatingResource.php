<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RatingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [  
            'id' => $this->id,  
            'user_id' => $this->user_id,  
            'type' => $this->type,  
            'date_id' => $this->date_id,  
            'rate' => $this->rate,  
            'created_at' => $this->created_at,  
            'updated_at' => $this->updated_at,  
        ];
    }
}
