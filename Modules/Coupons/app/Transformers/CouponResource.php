<?php

namespace Modules\Coupons\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CouponResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'unique_code' => $this->unique_code,
            'percent' => $this->percent,
            'max_amount' => $this->max_amount,
            'max_usage' => $this->max_usage,
            'started_at' => $this->started_at,
            'expire_at' => $this->expire_at,
            'created_at' => $this->created_at->format('Y-m-d'),
            'updated_at' => $this->updated_at->format('Y-m-d'),
        ];
    }
}
