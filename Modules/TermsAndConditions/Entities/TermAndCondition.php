<?php

namespace Modules\TermsAndConditions\Entities;

use Illuminate\Database\Eloquent\Model;

class TermAndCondition extends Model
{
    protected $fillable = ['content'];

    public $timestamps = false;
}
