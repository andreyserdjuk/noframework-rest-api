<?php

namespace AndreySerdjuk\HttpKernel;

use AndreySerdjuk\HttpFoundation\RequestInterface;

class ExceptionEvent extends GetResponseEvent
{
    /** @var  \Throwable */
    protected $exception;

    public function __construct(string $eventName, RequestInterface $request, \Throwable $exception)
    {
        parent::__construct($eventName, $request);
        $this->exception = $exception;
    }

    public function getException(): \Throwable
    {
        return $this->exception;
    }
}
