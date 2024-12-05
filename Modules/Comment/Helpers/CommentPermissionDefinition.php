<?php

namespace Modules\Comment\Helpers;

use Modules\Role\Abstracts\PermissionDefinition;

class CommentPermissionDefinition extends PermissionDefinition
{
    public static function permissions(): array
    {
        return [
            'comments' => self::generatePermissionsArray(),
        ];
    }
}
