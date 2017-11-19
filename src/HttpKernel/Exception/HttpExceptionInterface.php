<?php

namespace AndreySerdjuk\HttpKernel\Exception;

interface HttpExceptionInterface
{
    public function getHttpCode(): string ;
}
