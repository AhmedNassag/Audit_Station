<?php

namespace Modules\ContactUs\Helpers;

use Modules\Role\Abstracts\PermissionDefinition;

class ContactUsPermissionDefinition extends PermissionDefinition
{
    public static function permissions(): array
    {
        return [
            'contact_us' => self::generatePermissionsArray(['store', 'update']),
        ];
    }
}
