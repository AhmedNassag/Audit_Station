<?php

namespace Modules\Service\Helpers;

use Modules\Role\Abstracts\PermissionDefinition;

class ServicePermissionDefinition extends PermissionDefinition
{
    public static function permissions(): array
    {
        return [
            'services' => self::generatePermissionsArray(),
        ];
    }
}
