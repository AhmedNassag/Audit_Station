<?php

namespace Modules\Comment\Services;

use Modules\Comment\Models\Builders\CommentBuilder;
use Modules\Comment\Models\Comment;

class AdminCommentService extends BaseCommentService
{
    public function index(array $filters = [])
    {
        return $this->baseIndex($filters)->paginatedCollection();
    }

    public function show(array $filters, $id)
    {
        return Comment::query()
            ->when(true, fn (CommentBuilder $b) => $b->handleFilters($filters)->withDetails())
            ->findOrFail($id);
    }
}
