<?php

namespace Modules\Blog\Models\Builders;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Category\Models\Builders\CategoryBuilder;

class BlogBuilder extends Builder
{
    public function withMinimalAdminDetails()
    {
        return $this->select([
            'id',
            'title',
            'description',
            'category_id',
            'created_at',
        ])
            ->withCategoryDetails()
            ->with('image');
    }

    public function withMinimalSiteDetails()
    {
        return $this->select([
            'id',
            'title',
            'description',
            'created_at',
            'blog_author_id',
            'category_id',
        ])
            ->with('image')
            ->withCategoryDetails()
            ->when(! is_null('order_by_popular'), fn (self $builder) => $builder->withCount('customComments')->orderBy('custom_comments_count', 'desc'))
            ->withAuthorDetails();
    }

    public function withSiteDetails()
    {
        return $this->withAdminDetails();
    }

    public function withCategoryDetails(): BlogBuilder
    {
        return $this->with([
            'category' => fn (CategoryBuilder|BelongsTo $b) => $b->withDetails(),
        ]);
    }

    public function withAdminDetails()
    {
        return $this->withCategoryDetails()->withAuthorDetails()->with('image')->withCommentsCount();
    }

    public function withAuthorDetails()
    {
        return $this->with([
            'author' => fn (BlogAuthorBuilder|BelongsTo $b) => $b->withDetails(),
        ]);
    }

    public function withCommentsCount(): BlogBuilder
    {
        return $this->withCount('comments');
    }
}
