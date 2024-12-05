<?php

namespace Modules\Category\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class ValidCategoryScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $builder->whereHas('category', fn ($q) => $q->where('status', true));
    }
}
