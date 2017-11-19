<?php

namespace AndreySerdjuk\HttpKernel\Exception;

use AndreySerdjuk\HttpFoundation\ResponseInterface;

class UnauthenticatedException extends RuntimeException implements HttpExceptionInterface
{
    public function getHttpCode(): string
    {
        return ResponseInterface::HTTP_UNAUTHORIZED;
    }
}
