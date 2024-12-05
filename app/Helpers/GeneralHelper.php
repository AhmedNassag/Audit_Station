<?php

namespace App\Helpers;

use App\Http\Middleware\MustBeVerified;
use Modules\Auth\Enums\UserTypeEnum;
use Modules\Auth\Http\Middleware\EnabledMiddleware;

class GeneralHelper
{
    public static function adminMiddlewares(): array
    {
        return array_merge(self::getDefaultLoggedUserMiddlewares(), ['user_type_in:'.UserTypeEnum::ADMIN.'|'.UserTypeEnum::ADMIN_EMPLOYEE]);
    }

    public static function getDefaultLoggedUserMiddlewares(array $additionalMiddlewares = [
        MustBeVerified::class,
        EnabledMiddleware::class,
    ]): array
    {
        return [
            self::authMiddleware(),
            ...$additionalMiddlewares,
        ];
    }

    public static function authMiddleware(): string
    {
        return 'auth:sanctum';
    }
}
