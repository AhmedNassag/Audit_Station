<?php

namespace Modules\Blog\Models;

use App\Helpers\MediaHelper;
use App\Traits\PaginationTrait;
use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;
use Modules\Blog\Models\Builders\BlogAuthorBuilder;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class BlogAuthor extends Model implements HasMedia
{
    use InteractsWithMedia, PaginationTrait, Searchable;

    protected $fillable = ['name', 'description'];

    public function image()
    {
        return MediaHelper::mediaRelationship($this, 'blog_author');
    }

    public function resetImage()
    {
        $this->addMediaCollection('blog_author')->singleFile();
    }

    public function newEloquentBuilder($query)
    {
        return new BlogAuthorBuilder($query);
    }
}
