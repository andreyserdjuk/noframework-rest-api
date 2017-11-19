<?php

namespace AndreySerdjuk\HttpKernel\Controller;

use AndreySerdjuk\EventDispatcher\EventInterface;
use AndreySerdjuk\EventDispatcher\EventListenerInterface;
use AndreySerdjuk\HttpKernel\Exception\NotFoundException;
use AndreySerdjuk\HttpKernel\GetControllerEvent;

class ControllerResolvingListener implements EventListenerInterface
{
    /** @var  ControllerResolverInterface */
    protected $controllerResolver;

    public function __construct(ControllerResolverInterface $controllerResolver)
    {
        $this->controllerResolver = $controllerResolver;
    }

    public function call(EventInterface $event): void
    {
        if ($event instanceof GetControllerEvent) {
            $controller = $this->controllerResolver->resolve($event->getRequest());
            if (\is_array($controller)) {
                [$controller, $args] = $controller;
                $event->setController($controller);
                $event->setArgs($args);
            }

            throw new NotFoundException(sprintf('Resource "%s" not found', $event->getRequest()->getPath()));
        }
    }
}
