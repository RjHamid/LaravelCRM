<?php

namespace Modules\ProductSuiteManager\Transformers\ProductResources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Comments\Models\Comment;
use Modules\Comments\Transformers\ProductCommentResource;
use Modules\ProductSuiteManager\Transformers\CategoryResources\CategoryResource;
use Modules\ProductSuiteManager\Transformers\ProductResources\ProductDiscountResource;
use MongoDB\Driver\Exception\CommandException;

class ProductResource extends JsonResource
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

        $comments = [];

        $productCommend = Comment::query()->where('type' , 'product')
            ->where('data_id',$this->id)->exists();

        if ($productCommend)
        {
            $pc = Comment::query()->where('type' ,'product')
                ->where('data_id',$this->id)
                ->where('status','published')
                ->paginate(6);



            $comments =  ProductCommentResource::collection($pc)->response()->getData();
        }

        return [
            'id' => $this->id,
            'category' => new CategoryResource($this->category),
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
            'comments' => $comments


        ];
    }
}
