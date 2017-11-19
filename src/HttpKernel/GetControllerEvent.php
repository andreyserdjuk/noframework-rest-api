<?php

namespace AndreySerdjuk\HttpKernel;

use AndreySerdjuk\EventDispatcher\Event;
use AndreySerdjuk\HttpFoundation\RequestInterface;

class GetControllerEvent extends Event
{
    /** @var  RequestInterface */
    protected $request;

    /** @var  callable */
    protected $controller;

    /** @var  array */
    protected $args;

    public function __construct(string $eventName, RequestInterface $request)
    {
        parent::__construct($eventName);
        $this->request = $request;
    }

    public function getRequest(): RequestInterface
    {
        return $this->request;
    }

    public function getController(): ?callable
    {
        return $this->controller;
    }

    public function setController(callable $controller): void
    {
        $this->controller = $controller;
    }

    public function getArgs(): array
    {
        return $this->args;
    }

    public function setArgs(array $args): void
    {
        $this->args = $args;
    }
}
