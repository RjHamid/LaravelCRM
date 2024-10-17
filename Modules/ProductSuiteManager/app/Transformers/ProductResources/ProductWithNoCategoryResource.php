<?php

namespace Modules\ProductSuiteManager\Transformers\ProductResources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\ProductSuiteManager\Transformers\ProductResources\ProductDiscountResource;
use Modules\Rating\Models\Rate;
use Modules\Rating\Transformers\RateResource;

class ProductWithNoCategoryResource extends JsonResource
{


    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        $galleries = [];

        if ($this->galleries()->count() > 0)
        {
            $galleries = ProductGalleryResource::collection($this->galleries);
        }

        $rate = [];

        $productRating = $productCommend = Rate::query()->where('type' , 'product')
            ->where('data_id',$this->id)->exists();

        if ($productRating)
        {
            $ra = Rate::query()->where('type' ,'product')
                ->where('data_id',$this->id)
                ->get();


            $rate =  RateResource::collection($ra);
        }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'price' => $this->price,
            'description' => $this->description,
            'quantity' => $this->quantity,
            'pic' => $this->pic,
            'created_at' => $this->created_at->format('Y-m-d'),
            'updated_at' => $this->updated_at->format('Y-m-d'),
            'discount' => new ProductDiscountResource($this),
            'galleries' => $galleries,
            'rating' => $rate

        ];
    }
}
