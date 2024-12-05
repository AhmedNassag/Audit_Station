<?php

namespace Modules\PrivacyPolicy\Models;

use Illuminate\Database\Eloquent\Model;

class PrivacyPolicy extends Model
{
    public $timestamps = false;

    protected $fillable = ['content'];
}
