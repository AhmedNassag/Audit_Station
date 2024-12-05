<?php

namespace Modules\Accountant\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Accountant\Database\Factories\AccountantFactory;

class Accountant extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    protected static function newFactory(): AccountantFactory
    {
        //return AccountantFactory::new();
    }
}
