<?php

namespace Modules\Auth\Enums;

enum VerifyTokenTypeEnum
{
    const VERIFICATION = 0;

    const PASSWORD_RESET = 1;

    const UPDATE_EMAIL = 2;
}
