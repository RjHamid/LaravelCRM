<?php

namespace Modules\Blog\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\ProductSuiteManager\Transformers\CategoryResources\CategoryResource;
use Modules\User\Transformers\UserResource;

class BlogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [  
            'id' => $this->id,  
            'user_id' => $this->user_id,  
            'category_id' => $this->category_id,  
            'title' => $this->title,  
            'description' => $this->description,  
            'pic' => $this->pic,  
            'created_at' => $this->created_at,  
            'updated_at' => $this->updated_at,  
            'user' => new UserResource($this->whenLoaded('user')),  
            'category' => new CategoryResource($this->whenLoaded('category')),  
        ];
    }
}
