<?php

namespace Modules\Order\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [  
            'id' => $this->id,  
            'unique_code' => $this->unique_code,  
            'address_id' => $this->address_id,  
            'gate' => $this->gate,  
            'price_total' => $this->price_total,  
            'transaction_id' => $this->transaction_id,  
            'status' => $this->status,  
            'created_at' => $this->created_at,  
            'updated_at' => $this->updated_at,  
        ];
    }
}
