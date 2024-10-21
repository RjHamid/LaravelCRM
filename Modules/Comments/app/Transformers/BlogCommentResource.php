<?php

namespace Modules\Comments\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\User\Transformers\UserPublicResource;
use Modules\User\Transformers\UserResource;

class BlogCommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user' => new UserPublicResource($this->user),
            'type' => $this->type,
            'description' => $this->description,
            'created_at' => $this->created_at->format('Y-m-d'),
            'updated_at' => $this->updated_at->format('Y-m-d'),
        ];
    }
}
