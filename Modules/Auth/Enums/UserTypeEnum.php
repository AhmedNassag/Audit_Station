<?php

namespace Modules\Auth\Enums;

use App\Models\User;

enum UserTypeEnum
{
    const ADMIN = 0;

    const USER = 1;

    const COMPANY = 2;

    const INSTRUCTOR = 3;

    const ACCOUNTANT = 4;

    const CERTIFIED = 5;

    const INTERVIEWER = 6;

    const ADMIN_EMPLOYEE = 7;

    public static function availableTypes(): array
    {
        return [
            self::ADMIN,
            self::USER,
            self::COMPANY,
            self::INSTRUCTOR,
            self::ACCOUNTANT,
            self::CERTIFIED,
            self::INTERVIEWER,
            self::ADMIN_EMPLOYEE,
        ];
    }

    public static function getUserType(?User $user = null)
    {
        $user = ! is_null($user) ? $user : auth()->user();

        return $user?->type;
    }

    public static function alphaTypes(): array
    {
        return [
            self::ADMIN => 'admin',
            self::USER => 'user',
            self::COMPANY => 'company',
            self::INSTRUCTOR => 'instructor',
            self::ACCOUNTANT => 'accountant',
            self::CERTIFIED => 'certified',
            self::INTERVIEWER => 'interviewer',
            self::ADMIN_EMPLOYEE => 'admin_employee',
        ];
    }
}
