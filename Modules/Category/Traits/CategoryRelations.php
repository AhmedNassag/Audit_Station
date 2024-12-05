<?php

namespace Modules\Category\Traits;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Category\Models\Category;

trait CategoryRelations
{
    public function subCategories(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function parentCategory()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }
}
