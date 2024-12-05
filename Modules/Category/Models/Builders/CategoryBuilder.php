<?php

namespace Modules\Category\Models\Builders;

use Illuminate\Database\Eloquent\Builder;

class CategoryBuilder extends Builder
{
    public function withDetails()
    {
        return $this->select(['id', 'name', 'parent_id']);
    }
}
