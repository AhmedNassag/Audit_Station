<?php

namespace Modules\Comment\Models;

use App\Traits\PaginationTrait;
use Illuminate\Database\Eloquent\Model;
use Modules\Comment\Models\Builders\CommentBuilder;
use Modules\Comment\Traits\CommentRelations;

class Comment extends Model
{
    use CommentRelations, PaginationTrait;

    protected $fillable = [
        'content',
        'user_id',
        'commentable_id',
        'commentable_type',
        'parent_id',
    ];

    public function newEloquentBuilder($query)
    {
        return new CommentBuilder($query);
    }
}
