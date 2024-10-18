<?php

namespace Modules\ShopFlow\Transformers\OrderResources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\ShopFlow\Transformers\CartResources\CartResource;
use Modules\ShopFlow\Transformers\S\OrderProgressResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user' => $this->user_id,
            'code' => $this->unique_code,
            'address' => $this->address_id,
            'gate' => $this->gate,
            'price_total' => $this->price_total,
            'status' => $this->status,
            'progress' => new OrderProgressResource($this->progress),
            'carts' => CartResource::collection($this->carts)
        ];
    }
}