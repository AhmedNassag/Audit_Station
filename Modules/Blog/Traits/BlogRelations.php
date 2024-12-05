<?php

namespace Modules\Blog\Traits;

use App\Helpers\MediaHelper;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Modules\Blog\Models\BlogAuthor;
use Modules\Category\Models\Category;
use Modules\Comment\Models\Comment;

trait BlogRelations
{
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(BlogAuthor::class, 'blog_author_id');
    }

    public function image()
    {
        return MediaHelper::mediaRelationship($this, 'blog_image');
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function customComments()
    {
        return $this->comments();
    }
}
