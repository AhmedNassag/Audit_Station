<?php

namespace Modules\Faqs\Helpers;

use Modules\Role\Abstracts\PermissionDefinition;

class FaqsPermissionDefinition extends PermissionDefinition
{
    public static function permissions(): array
    {
        return [
            'faqs' => self::generatePermissionsArray(),
        ];
    }
}
