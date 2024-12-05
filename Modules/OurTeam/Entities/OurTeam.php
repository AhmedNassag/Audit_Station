<?php

namespace Modules\OurTeam\Entities;

use App\Helpers\MediaHelper;
use App\Traits\PaginationTrait;
use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;
use Modules\OurTeam\Http\Controllers\AdminOurTeamController;
use Modules\OurTeam\Traits\OurTeamRelation;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class OurTeam extends Model implements HasMedia
{
    use InteractsWithMedia, OurTeamRelation, PaginationTrait, Searchable;

    protected $fillable = [
        'name',
        'section_id',
        'facebook',
        'instagram',
        'twitter',
        'telegram',
        'whatsapp',
        'snapchat',
        'tiktok',
        'github',
    ];

    public function image()
    {
        return MediaHelper::mediaRelationship($this, AdminOurTeamController::$collectionName);
    }

    public function resetImage()
    {
        $this->addMediaCollection(AdminOurTeamController::$collectionName)->singleFile();
    }
}
