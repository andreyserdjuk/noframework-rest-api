<?php

namespace AndreySerdjuk\Security\Authentication\EntryPoint;

use AndreySerdjuk\HttpFoundation\RequestInterface;
use AndreySerdjuk\HttpFoundation\Response;
use AndreySerdjuk\HttpFoundation\ResponseInterface;

class BasicAuthEntryPoint implements EntryPointInterface
{
    protected $realm;

    protected $route;

    public function __construct($realm, $route)
    {
        $this->realm = $realm;
        $this->route = $route;
    }

    public function getAuthResponse(RequestInterface $request): ResponseInterface
    {
        return new Response(
            '',
            ResponseInterface::HTTP_UNAUTHORIZED,
            [
                'WWW-Authenticate' => sprintf('Basic realm="%s"', $this->realm)
            ]
        );
    }

    public function getRoute(): string
    {
        return $this->route;
    }
}
