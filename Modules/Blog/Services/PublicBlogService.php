<?php

namespace Modules\Blog\Services;

use App\Exceptions\ValidationErrorsException;
use Modules\Blog\Models\Blog;
use Modules\Blog\Models\Builders\BlogBuilder;

class PublicBlogService
{
    public function index()
    {
        $categoryId = request()->input('category_id');
        $authorId = request()->input('author_id');

        return Blog::query()
            ->when(true, fn (BlogBuilder $b) => $b->withMinimalSiteDetails())
            ->searchByForeignKey('category_id', $categoryId)
            ->searchByForeignKey('blog_author_id', $authorId)
            ->searchable(['title'])
            ->paginatedCollection();
    }

    public function show($id)
    {
        return Blog::query()
            ->when(true, fn (BlogBuilder $b) => $b->withSiteDetails())
            ->findOrFail($id);
    }

    public function exists($id, string $errorKey = 'blog_id')
    {
        $blog = Blog::query()->find($id);

        if (! $blog) {
            throw new ValidationErrorsException([
                $errorKey => translate_error_message('blog', 'not_exists'),
            ]);
        }

        return $blog;
    }
}
