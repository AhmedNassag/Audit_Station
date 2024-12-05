<?php

namespace Modules\Comment\Helpers;

use App\Helpers\BaseExceptionHelper;
use Illuminate\Foundation\Configuration\Exceptions;
use Modules\Comment\Exceptions\CommentException;

class CommentExceptionHelper extends BaseExceptionHelper
{
    public static function handle(Exceptions $exceptions)
    {
        $exceptions->renderable(fn (CommentException $e) => self::generalErrorResponse($e));
    }
}
