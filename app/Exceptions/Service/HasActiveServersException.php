<?php

namespace SneakyPanel\Exceptions\Service;

use Illuminate\Http\Response;
use SneakyPanel\Exceptions\DisplayException;

class HasActiveServersException extends DisplayException
{
    public function getStatusCode(): int
    {
        return Response::HTTP_BAD_REQUEST;
    }
}
