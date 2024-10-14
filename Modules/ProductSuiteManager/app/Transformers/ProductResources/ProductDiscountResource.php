<?php

namespace Modules\ProductSuiteManager\Transformers\ProductResources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductDiscountResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        if ($this->has_discount)
        {
            return [
                'percent' => $this->discount_percent,
                'price_with_discount' => $this->price_with_discount,
                'created_at' => $this->discount->created_at->format('Y-m-d'),
                'updated_at' => $this->discount->updated_at->format('Y-m-d'),
            ];
        }else
        {
            return [];
        }
    }
}
