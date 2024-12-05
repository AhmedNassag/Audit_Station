<?php

namespace Modules\Blog\Models\Builders;

use Illuminate\Database\Eloquent\Builder;

class BlogAuthorBuilder extends Builder
{
    public function withDetails()
    {
        return $this->select(['id', 'name', 'description'])->with('image');
    }

    public function withMinimalDetails()
    {
        return $this->select(['id', 'name']);
    }
}
