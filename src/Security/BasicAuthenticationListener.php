<?php

namespace AndreySerdjuk\Security;

use AndreySerdjuk\EventDispatcher\EventInterface;
use AndreySerdjuk\EventDispatcher\EventListenerInterface;
use AndreySerdjuk\HttpFoundation\Auth\Basic\Credentials;
use AndreySerdjuk\HttpKernel\Exception\UnauthenticatedException;
use AndreySerdjuk\HttpKernel\GetResponseEvent;
use AndreySerdjuk\Security\Authentication\EntryPoint\EntryPointInterface;

class BasicAuthenticationListener implements EventListenerInterface
{
    /** @var  EntryPointInterface */
    protected $entryPoint;

    public function __construct(EntryPointInterface $entryPoint)
    {
        $this->entryPoint = $entryPoint;
    }

    public function call(EventInterface $event): void
    {
        if ($event instanceof GetResponseEvent) {
            $request = $event->getRequest();
//            if (preg_match($this->entryPoint->getRoute(), $request->getPath())) {
//                return;
//            }

            $creds = Credentials::fromRequest($request);

            if (!$creds->getPassword() || !$creds->getUser()) {
                $event->stopPropagation();
                throw new UnauthenticatedException(
                    sprintf(
                        'Resource "%s" requires authenticated access.',
                        $request->getPath()
                    )
                );
            }
        }
    }
}
