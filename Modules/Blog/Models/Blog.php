<?php

namespace Modules\Blog\Models;

use App\Traits\PaginationTrait;
use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;
use Modules\Blog\Models\Builders\BlogBuilder;
use Modules\Blog\Traits\BlogRelations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Blog extends Model implements HasMedia
{
    use BlogRelations, InteractsWithMedia, PaginationTrait, Searchable;

    protected $fillable = [
        'title',
        'description',
        'blog_author_id',
        'category_id',
        'tags',
        'minutes',
    ];

    protected $casts = [
        'tags' => 'array',
    ];

    public function resetImage()
    {
        $this->addMediaCollection('blog_image')->singleFile();
    }

    public function newEloquentBuilder($query)
    {
        return new BlogBuilder($query);
    }
}
