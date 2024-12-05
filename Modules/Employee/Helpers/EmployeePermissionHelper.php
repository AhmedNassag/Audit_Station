<?php

namespace Modules\Employee\Helpers;

use Modules\Role\Abstracts\PermissionDefinition;

class EmployeePermissionHelper extends PermissionDefinition
{
    public static function permissions(): array
    {
        return [
            'employee' => self::generatePermissionsArray(additionalPermissions: ['change_status']),
        ];
    }
}
