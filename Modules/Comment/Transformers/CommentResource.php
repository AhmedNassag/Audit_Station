<?php

namespace Modules\Comment\Transformers;

use App\Helpers\ResourceHelper;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Auth\Transformers\UserResource;
use Modules\Comment\Enums\CommentTypeEnum;

class CommentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->when(ResourceHelper::shouldReturnForeignKey($this, 'user', 'user_id'), $this->user_id),
            'type' => $this->whenHas('commentable_type', fn () => CommentTypeEnum::getType($this->commentable_type)),
            'content' => $this->whenHas('content'),
            'created_at' => $this->whenHas('created_at'),
            'replies_count' => $this->whenHas('replies_count'),
            'user' => $this->whenLoaded('user', function () {
                return UserResource::make($this->user);
            }),
            'replies' => $this->whenLoaded('replies', function () {
                return CommentResource::collection($this->replies);
            }),
        ];
    }
}
