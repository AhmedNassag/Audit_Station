<?php

namespace Modules\Blog\Transformers;

use App\Helpers\ResourceHelper;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Category\Transformers\CategoryResource;

class BlogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->whenHas('title'),
            'comments_count' => $this->whenHas('comments_count'),
            'minutes' => $this->whenHas('minutes'),
            'created_at' => $this->whenHas('created_at'),
            'image' => $this->whenNotNull(ResourceHelper::getFirstMediaOriginalUrl($this, 'image')),
            'category_id' => $this->when(ResourceHelper::shouldReturnForeignKey($this, 'category', 'category_id'), $this->category_id),
            'blog_author_id' => $this->when(ResourceHelper::shouldReturnForeignKey($this, 'author', 'blog_author_id'), $this->blog_author_id),
            'description' => $this->whenHas('description'),
            'tags' => $this->whenHas('tags'),
            'author' => $this->whenLoaded('author', function () {
                return BlogAuthorResource::make($this->author);
            }),
            'category' => $this->whenLoaded('category', function () {
                return CategoryResource::make($this->category);
            }),
        ];
    }
}
