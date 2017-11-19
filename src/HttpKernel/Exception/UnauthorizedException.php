<?php

namespace AndreySerdjuk\HttpKernel\Exception;

use AndreySerdjuk\HttpFoundation\ResponseInterface;

class UnauthorizedException extends RuntimeException implements HttpExceptionInterface
{
    public function getHttpCode(): string
    {
        return ResponseInterface::HTTP_FORBIDDEN;
    }
}
