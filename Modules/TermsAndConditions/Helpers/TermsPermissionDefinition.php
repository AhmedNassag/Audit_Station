<?php

namespace Modules\TermsAndConditions\Helpers;

use Modules\Role\Abstracts\PermissionDefinition;

class TermsPermissionDefinition extends PermissionDefinition
{
    public static function permissions(): array
    {
        return [
            'terms_and_conditions' => self::generatePermissionsArray(['all', 'store', 'delete']),
        ];
    }
}
