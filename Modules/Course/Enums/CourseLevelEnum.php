<?php

namespace Modules\Course\Enums;

enum CourseLevelEnum
{
    const BEGINNER = 0;

    const INTERMEDIATE = 1;

    const ADVANCED = 2;

    public static function toArray(): array
    {
        return [
            self::BEGINNER,
            self::INTERMEDIATE,
            self::ADVANCED,
        ];
    }
}
