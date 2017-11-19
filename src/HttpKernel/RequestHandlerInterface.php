<?php

namespace AndreySerdjuk\HttpKernel;

use AndreySerdjuk\HttpFoundation\RequestInterface;
use AndreySerdjuk\HttpFoundation\ResponseInterface;

interface RequestHandlerInterface
{
    public function handle(RequestInterface $request): ResponseInterface;
}
