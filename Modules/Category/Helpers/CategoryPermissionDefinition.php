<?php

namespace Modules\Category\Helpers;

use Modules\Role\Abstracts\PermissionDefinition;

class CategoryPermissionDefinition extends PermissionDefinition
{
    public static function permissions(): array
    {
        return [
            'parent_category' => self::generatePermissionsArray(),
            'sub_category' => self::generatePermissionsArray(),
        ];
    }
}
