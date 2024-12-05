<?php

namespace Modules\Section\Helpers;

use Modules\Role\Abstracts\PermissionDefinition;

class SectionPermissionHelper extends PermissionDefinition
{
    public static function permissions(): array
    {
        return [
            'section' => self::generatePermissionsArray(),
        ];
    }
}
