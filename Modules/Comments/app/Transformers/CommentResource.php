<?php

namespace Modules\Comments\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\ProductSuiteManager\Models\Product;
use Modules\ProductSuiteManager\Transformers\ProductResources\ProductResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {

        $data = null;

        if ($this->type == 'product' || 'محصول')
        {
            $productId = $this->data_id;
            $product =  Product::query()->where('id' , $productId)
                ->firstOrFail();

            $data  = new ProductResource($product);

        }
        elseif ($this->type == 'blog' || 'بلاگ')
        {
            /*بمونه برای بعد*/
        }

        return [
            'id' => $this->id,
            /*این بعدا باید درست شه*/
            'user' => $this->user_id,
            'type' => $this->type,
            'status' => $this->status,
            'data' => $data,
            'description' => $this->description,
            'created_at' => $this->created_at->format('Y-m-d'),
            'updated_at' => $this->updated_at->format('Y-m-d'),
        ];
    }
}
