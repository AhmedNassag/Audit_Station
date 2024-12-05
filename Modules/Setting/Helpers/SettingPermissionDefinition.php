<?php

namespace Modules\Setting\Helpers;

use Modules\Role\Abstracts\PermissionDefinition;

class SettingPermissionDefinition extends PermissionDefinition
{
    public static function permissions(): array
    {
        return [
            'setting' => self::generatePermissionsArray(['all', 'store', 'delete']),
        ];
    }
}
