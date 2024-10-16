<?php

namespace Modules\ShopFlow\Transformers\CartResources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\ProductSuiteManager\Transformers\ProductResources\ProductForCartResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user'  => $this->user_id,
            'product' => new ProductForCartResource($this->product),
            'count' => $this->count,
            'price_unit' => $this->price_unit,
            'created_at' => $this->created_at->format('Y-m-d'),
            'updated_at' => $this->updated_at->format('Y-m-d'),
        ];
    }
}
