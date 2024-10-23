<?php

namespace Modules\Blog\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\ProductSuiteManager\Transformers\CategoryResources\CategoryResource;
use Modules\Rating\Models\Rate;
use Modules\Rating\Transformers\RateResource;
use Modules\User\Transformers\UserPublicResource;

class BlogWithNoCategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {

        $rate = [];

        $blogRating =  Rate::query()->where('type' , 'blog')
            ->where('data_id',$this->id)->exists();

        if ($blogRating)
        {
            $ra = Rate::query()->where('type' ,'blog')
                ->where('data_id',$this->id)
                ->get();


            $rate =  RateResource::collection($ra);
        }

        return [
            'id' => $this->id,
            'user' => new UserPublicResource($this->user),
            'title' => $this->title,
            'description' => $this->description,
            'pic' => $this->pic,
            'created_at' => $this->created_at->format('Y-m-d'),
            'updated_at' => $this->updated_at->format('Y-m-d'),
            'rating' => $rate ,
        ];
    }
}
