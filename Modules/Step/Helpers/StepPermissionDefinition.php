<?php

namespace Modules\Step\Helpers;

use Modules\Role\Abstracts\PermissionDefinition;

class StepPermissionDefinition extends PermissionDefinition
{
    public static function permissions(): array
    {
        return [
            'steps' => self::generatePermissionsArray(),
        ];
    }
}
