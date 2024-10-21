<?php

namespace Modules\Blog\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\ProductSuiteManager\Transformers\CategoryResources\CategoryResource;
use Modules\User\Transformers\UserResource;

class BlogWithNoattributeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {

        return [
            'id' => $this->id,
            'user' => new UserResource($this->user),
            'category' => new CategoryResource($this->category),
            'title' => $this->title,
            'description' => $this->description,
            'pic' => $this->pic,
            'created_at' => $this->created_at->format('Y-m-d'),
            'updated_at' => $this->updated_at->format('Y-m-d'),
        ];
    }
}
