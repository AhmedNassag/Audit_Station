<?php

namespace Modules\Setting\Models;

use Elattar\LaravelMysqlSpatial\Eloquent\SpatialTrait;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use SpatialTrait;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'facebook',
        'linkedin',
        'youtube',
        'tiktok',
        'snapchat',
        'app_store',
        'google_play',
        'head_quarters',
        'our_branches',
        'location',
        'address',
        'phones',
        'email',
    ];

    protected $casts = [
        'phones' => 'array',
        'head_quarters' => 'array',
        'our_branches' => 'array',
    ];

    protected $spatialFields = ['location'];
}
