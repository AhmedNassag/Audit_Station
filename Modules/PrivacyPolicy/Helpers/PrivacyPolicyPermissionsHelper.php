<?php

namespace Modules\PrivacyPolicy\Helpers;

use Modules\Role\Abstracts\PermissionDefinition;

class PrivacyPolicyPermissionsHelper extends PermissionDefinition
{
    public static function permissions(): array
    {
        return [
            'privacy_policy' => self::generatePermissionsArray(['all', 'delete', 'store']),
        ];
    }
}
