<?php

namespace Modules\Comment\Models\Builders;

use App\Models\Builders\UserBuilder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Pipeline;
use Modules\Comment\Enums\CommentTypeEnum;
use Modules\Comment\Models\Filters\CommentForeignKeyFilter;

class CommentBuilder extends Builder
{
    public function handleFilters(array $filters): static
    {
        $this
            ->where('commentable_type', CommentTypeEnum::getModelType($filters['type']));

        return Pipeline::send($this)
            ->through([
                fn ($query, $next) => CommentForeignKeyFilter::handle($query, $next, $filters),
            ])->thenReturn();
    }

    public function withUserDetails(): CommentBuilder
    {
        return $this->with([
            'user' => fn (UserBuilder|BelongsTo $b) => $b->withMinimalDetails(),
        ]);
    }

    public function withDetails()
    {
        return $this->withUserDetails()->withRepliesCount();
    }

    public function withRepliesCount()
    {
        return $this->withCount('replies');
    }
}
