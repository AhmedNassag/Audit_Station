<?php

namespace Modules\Comment\Models\Filters;

use Illuminate\Database\Eloquent\Builder;

class CommentForeignKeyFilter
{
    public static function handle(Builder $builder, $next, array $filters)
    {
        $keys = ['user_id', 'commentable_id', 'parent_id'];

        foreach ($keys as $key) {
            if (isset($filters[$key])) {
                $builder->where($key, $filters[$key]);
            }

            if ($key == 'parent_id') {
                $builder->where($key, $filters[$key] ?? null);
            }
        }

        return $next($builder);
    }
}
