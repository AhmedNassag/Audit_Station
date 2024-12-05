<?php

namespace Modules\Section\Entities;

use App\Traits\PaginationTrait;
use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;
use Modules\Section\Traits\SectionRelations;

class Section extends Model
{
    use PaginationTrait, Searchable, SectionRelations;

    protected $fillable = ['title'];
}
