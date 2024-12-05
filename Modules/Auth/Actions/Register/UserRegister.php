<?php

namespace Modules\Auth\Actions\Register;

use Modules\Auth\Enums\UserTypeEnum;
use Modules\Auth\Strategies\Verifiable;

class UserRegister
{
    public function handle(array $data, bool $shouldVerify = true)
    {
        $data['type'] = UserTypeEnum::USER;

        (new BaseRegisterAction)->handle($data, app(Verifiable::class), shouldVerify: $shouldVerify);
    }
}
