<?php

namespace AndreySerdjuk\Security\Authentication\EntryPoint;

use AndreySerdjuk\HttpFoundation\RequestInterface;
use AndreySerdjuk\HttpFoundation\ResponseInterface;

interface EntryPointInterface
{
    public function getAuthResponse(RequestInterface $request): ResponseInterface;

    public function getRoute(): string ;
}
