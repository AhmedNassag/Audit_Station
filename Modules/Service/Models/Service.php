<?php

namespace Modules\Service\Models;

use App\Helpers\MediaHelper;
use App\Traits\PaginationTrait;
use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Service extends Model implements HasMedia
{
    use InteractsWithMedia, PaginationTrait, Searchable;

    /**
     * The attributes that are mass assignable.
     **/
    protected $fillable = [
        'title',
        'description',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function image()
    {
        return MediaHelper::mediaRelationship($this, 'services_image');
    }

    public function resetImage(): void
    {
        $this->addMediaCollection('services_image')->singleFile();
    }
}
