<?php

namespace Modules\AboutUs\Helpers;

use Modules\Role\Abstracts\PermissionDefinition;

class AboutUsPermissionDefinition extends PermissionDefinition
{
    public static function permissions(): array
    {
        return [
            'about_us' => self::generatePermissionsArray(['all', 'store', 'delete']),
        ];
    }
}
