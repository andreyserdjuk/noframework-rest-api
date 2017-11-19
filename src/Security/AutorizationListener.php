<?php

namespace AndreySerdjuk\Security;

use AndreySerdjuk\EventDispatcher\EventInterface;
use AndreySerdjuk\EventDispatcher\EventListenerInterface;
use AndreySerdjuk\HttpFoundation\Auth\Basic\Credentials;
use AndreySerdjuk\HttpKernel\Exception\UnauthorizedException;
use AndreySerdjuk\HttpKernel\GetResponseEvent;
use AndreySerdjuk\Security\Authentication\EntryPoint\EntryPointInterface;

class AutorizationListener implements EventListenerInterface
{
    /** @var  array */
    protected $allowedUsers;

    /** @var  EntryPointInterface */
    protected $entryPoint;

    public function __construct(array $allowedUsers, EntryPointInterface $entryPoint)
    {
        $this->allowedUsers = $allowedUsers;
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

            $user = $creds->getUser();
            $password = $creds->getPassword();

            foreach ($this->allowedUsers as $userData) {
                if (isset($userData['username'], $userData['password']) &&
                    $userData['username'] === $user &&
                    $userData['password'] === $password
                ) {
                    return;
                }
            }

            throw new UnauthorizedException(sprintf(
                'Resource "%s" is not granted for current User.',
                $request->getPath()
            ));
        }
    }
}
