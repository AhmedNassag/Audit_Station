<?php

namespace Modules\Category\Services;

use App\Exceptions\ValidationErrorsException;
use Modules\Category\Models\Category;

class CategoryService
{
    public function exists($id, string $errorKey = 'category_id')
    {
        $category = Category::query()->find($id);

        if (! $category) {
            throw new ValidationErrorsException([
                $errorKey => translate_error_message('category', 'not_exists'),
            ]);
        }

        return $category;
    }
}
