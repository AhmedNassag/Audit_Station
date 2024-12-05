<?php

namespace Modules\Auth\Helpers;

use Modules\Auth\Enums\UserTypeEnum;

class UserTypeHelper
{
    public static function nonMobileTypes(): array
    {
        return [
            UserTypeEnum::ADMIN,
            UserTypeEnum::ADMIN_EMPLOYEE,
        ];
    }

    public static function mobileTypes(): array
    {
        return [
            UserTypeEnum::USER,
            UserTypeEnum::INTERVIEWER,
            UserTypeEnum::INSTRUCTOR,
            UserTypeEnum::COMPANY,
            UserTypeEnum::CERTIFIED,
            UserTypeEnum::ACCOUNTANT,
        ];
    }
}
