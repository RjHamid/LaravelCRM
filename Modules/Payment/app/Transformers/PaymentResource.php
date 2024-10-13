<?php

namespace Modules\Payment\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [  
            'id' => $this->id,  
            'order_id' => $this->order_id,  
            'tracking_code' => $this->tracking_code,  
            'card_pin' => $this->card_pin,  
            'total_price' => $this->total_price,  
            'status' => $this->status,  
            'created_at' => $this->created_at,  
            'updated_at' => $this->updated_at,  
        ];
    }
}
