<?php

namespace Modules\Category\Services;

use Modules\Category\Models\Category;

class ClientCategoryService
{
    public function parentCategories()
    {
        return Category::query()
            ->whereNull('parent_id')
            ->where('status', true)
//            ->with('image')
            ->searchable()
            ->paginatedCollection();
    }

    public function subCategories($parentId)
    {
        return Category::query()
            ->whereNotNull('parent_id')
            ->where('parent_id', $parentId)
            ->where('status', true)
//            ->with('image')
            ->searchable()
            ->paginatedCollection();
    }
}
