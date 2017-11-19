<?php

namespace AndreySerdjuk\HttpKernel\Exception;

use AndreySerdjuk\HttpFoundation\ResponseInterface;

class NotFoundException extends RuntimeException implements HttpExceptionInterface
{
    public function getHttpCode(): string
    {
        return ResponseInterface::HTTP_NOT_FOUND;
    }
}
