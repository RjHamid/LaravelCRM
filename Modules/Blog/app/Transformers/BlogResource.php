<?php

namespace Modules\Blog\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Comments\Models\Comment;
use Modules\Comments\Transformers\BlogCommentResource;
use Modules\Comments\Transformers\ProductCommentResource;
use Modules\ProductSuiteManager\Transformers\CategoryResources\CategoryResource;
use Modules\Rating\Models\Rate;
use Modules\Rating\Transformers\RateResource;
use Modules\User\Transformers\UserPublicResource;
use Modules\User\Transformers\UserResource;

class BlogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {

        $comments = [];

        $blogCommend = Comment::query()->where('type' , 'blog')
            ->where('data_id',$this->id)->exists();

        if ($blogCommend)
        {
            $pc = Comment::query()->where('type' ,'blog')
                ->where('data_id',$this->id)
                ->where('status','published')
                ->paginate(6);

            $comments =  BlogCommentResource::collection($pc)->response()->getData();
        }

        $rate = [];

        $productRating =  Rate::query()->where('type' , 'blog')
            ->where('data_id',$this->id)->exists();

        if ($productRating)
        {
            $ra = Rate::query()->where('type' ,'blog')
                ->where('data_id',$this->id)
                ->get();


            $rate =  RateResource::collection($ra);
        }

        return [  
            'id' => $this->id,  
            'user' => new UserPublicResource($this->user),
            'category' => new CategoryResource($this->category),  
            'title' => $this->title,  
            'description' => $this->description,  
            'pic' => $this->pic,  
            'created_at' => $this->created_at->format('Y-m-d'),
            'updated_at' => $this->updated_at->format('Y-m-d'),
            'rating' => $rate ,
            'comments' => $comments ,
          
        ];
    }
}
