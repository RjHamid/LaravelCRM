<?php

namespace Modules\ProductSuiteManager\Transformers\CategoryResources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\ProductSuiteManager\Transformers\ProductResources\ProductWithNoCategoryResource;

class CategoryProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return ['id' => $this->id,
            'parent' => new CategoryResource($this->parent),
            'title' => $this->title,
            'slug' => $this->slug,
            'type' =>$this->type,
            'created_at' => $this->created_at->format('Y-m-d'),
            'updated_at' => $this->updated_at->format('Y-m-d'),
            'products' =>  ProductWithNoCategoryResource::collection($this->products)
        ];
    }
}
