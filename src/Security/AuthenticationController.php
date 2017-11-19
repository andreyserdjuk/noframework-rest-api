<?php

namespace AndreySerdjuk\Security;

use AndreySerdjuk\HttpFoundation\RequestInterface;
use AndreySerdjuk\HttpKernel\Kernel;
use AndreySerdjuk\Security\Authentication\EntryPoint\EntryPointInterface;

class AuthenticationController
{
    /** @var  EntryPointInterface */
    protected $entryPoint;

    public function __construct(EntryPointInterface $entryPoint)
    {
        $this->entryPoint = $entryPoint;
    }

    public function __invoke(RequestInterface $request, $args, Kernel $kernel)
    {
        return $this->entryPoint->getAuthResponse($request);
    }
}
