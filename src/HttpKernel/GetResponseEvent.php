<?php

namespace AndreySerdjuk\HttpKernel;

use AndreySerdjuk\EventDispatcher\Event;
use AndreySerdjuk\HttpFoundation\RequestInterface;
use AndreySerdjuk\HttpFoundation\ResponseInterface;

class GetResponseEvent extends Event
{
    /** @var  RequestInterface */
    protected $request;

    /** @var  ResponseInterface */
    protected $response;

    public function __construct(string $eventName, RequestInterface $request)
    {
        parent::__construct($eventName);
        $this->request = $request;
    }

    public function getRequest(): RequestInterface
    {
        return $this->request;
    }

    public function getResponse(): ?ResponseInterface
    {
        return $this->response;
    }

    public function setResponse(ResponseInterface $response): void
    {
        $this->response = $response;
    }
}
