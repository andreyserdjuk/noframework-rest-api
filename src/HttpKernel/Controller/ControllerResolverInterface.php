<?php

namespace AndreySerdjuk\HttpKernel\Controller;

use AndreySerdjuk\HttpFoundation\RequestInterface;

interface ControllerResolverInterface
{
    public function resolve(RequestInterface $request): ?array ;
}
