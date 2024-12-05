<?php

namespace Modules\AboutUs\Models;

use App\Helpers\MediaHelper;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class AboutUs extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'title',
        'description',
        'youtube_link',
        'items',
    ];

    protected $casts = [
        'items' => 'array',
    ];

    public function image()
    {
        return MediaHelper::mediaRelationship($this, 'about_us_image');
    }

    public function resetImage(): void
    {
        $this->addMediaCollection('about_us_image')->singleFile();
    }
}
