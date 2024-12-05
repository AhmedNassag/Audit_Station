<?php

namespace Modules\Category\Models;

use App\Traits\PaginationTrait;
use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Category\Models\Builders\CategoryBuilder;
use Modules\Category\Traits\CategoryRelations;

class Category extends Model
{
    use CategoryRelations, PaginationTrait, Searchable, SoftDeletes;

    protected $fillable = ['name', 'parent_id', 'status'];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function newEloquentBuilder($query): CategoryBuilder
    {
        return new CategoryBuilder($query);
    }
}
