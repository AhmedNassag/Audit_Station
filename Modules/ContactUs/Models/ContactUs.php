<?php

namespace Modules\ContactUs\Models;

use App\Traits\PaginationTrait;
use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    use PaginationTrait, Searchable;

    protected $fillable = [
        'email',
        'name',
        'subject',
        'message',
    ];
}
