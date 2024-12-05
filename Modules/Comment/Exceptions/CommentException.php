<?php

namespace Modules\Comment\Exceptions;

use App\Exceptions\BaseExceptionClass;
use Symfony\Component\HttpFoundation\Response;

class CommentException extends BaseExceptionClass
{
    /**
     * @throws CommentException
     */
    public static function invalidType()
    {
        throw new self('Invalid comment type', Response::HTTP_BAD_REQUEST);
    }
}
