<?php

namespace Modules\OurTeam\Helpers;

use Modules\Role\Abstracts\PermissionDefinition;

class OurTeamPermissionsHelper extends PermissionDefinition
{
    public static function permissions(): array
    {
        return [
            'our_team' => self::generatePermissionsArray(),
        ];
    }
}
