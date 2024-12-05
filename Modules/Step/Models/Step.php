<?php

namespace Modules\Step\Models;

use App\Helpers\MediaHelper;
use App\Traits\PaginationTrait;
use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Step extends Model implements HasMedia
{
    use InteractsWithMedia, PaginationTrait, Searchable;

    protected $fillable = ['content'];

    public function image()
    {
        return MediaHelper::mediaRelationship($this, 'steps_to_be_unique_image');
    }

    public function resetImage(): void
    {
        $this->addMediaCollection('steps_to_be_unique_image')->singleFile();
    }
}
