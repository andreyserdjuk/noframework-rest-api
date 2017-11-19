<?php

namespace AndreySerdjuk\HttpKernel\Exception;

use AndreySerdjuk\HttpFoundation\ResponseInterface;

class InternalErrorException extends \RuntimeException implements HttpExceptionInterface
{
    public function getHttpCode(): string
    {
        return ResponseInterface::HTTP_INTERNAL_SERVER_ERROR;
    }
}
