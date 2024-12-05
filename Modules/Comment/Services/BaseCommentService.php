<?php

namespace Modules\Comment\Services;

use Modules\Comment\Models\Builders\CommentBuilder;
use Modules\Comment\Models\Comment;

class BaseCommentService
{
    protected function baseIndex(array $filters)
    {
        return Comment::query()
            ->when(true, fn (CommentBuilder $b) => $b->handleFilters($filters)->withDetails())
            ->latest();
    }
}
