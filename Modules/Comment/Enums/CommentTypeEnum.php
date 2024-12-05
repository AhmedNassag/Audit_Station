<?php

namespace Modules\Comment\Enums;

use Modules\Blog\Models\Blog;

enum CommentTypeEnum
{
    const BLOG = 0;

    public static function toArray(): array
    {
        return [self::BLOG];
    }

    public static function modelTypes(): array
    {
        return [
            self::BLOG => Blog::class,
        ];
    }

    public static function getModelType($type): string
    {
        return self::modelTypes()[$type];
    }

    public static function getType($type)
    {
        return self::BLOG;
    }
}
