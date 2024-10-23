<?php

namespace Modules\Comments\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Blog\Models\Blog;
use Modules\Blog\Transformers\BlogResource;
use Modules\Blog\Transformers\BlogWithNoattributeResource;
use Modules\ProductSuiteManager\Models\Product;
use Modules\ProductSuiteManager\Transformers\ProductResources\ProductForCartResource;
use Modules\ProductSuiteManager\Transformers\ProductResources\ProductResource;
use Modules\User\Transformers\UserResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {

        $data = null;

        if ($this->type == 'product')
        {
            $productId = $this->data_id;
            $product =  Product::query()->where('id' , $productId)
                ->firstOrFail();

            $data  = new ProductForCartResource($product);

        }
        elseif ($this->type == 'blog')
        {
            $blogId = $this->data_id;
            $blog =  Blog::query()->where('id' , $blogId)
                ->firstOrFail();

            $data  = new BlogWithNoattributeResource($blog);
        }

        return [
            'id' => $this->id,
            'user' => new UserResource($this->user),
            'type' => $this->type,
            'status' => $this->status,
            'data' => $data,
            'description' => $this->description,
            'created_at' => $this->created_at->format('Y-m-d'),
            'updated_at' => $this->updated_at->format('Y-m-d'),
        ];
    }
}
