<?php

namespace AndreySerdjuk\Tests\HttpKernel;

use AndreySerdjuk\HttpFoundation\JsonReponse;
use AndreySerdjuk\HttpFoundation\Request;
use AndreySerdjuk\HttpFoundation\RequestInterface;
use AndreySerdjuk\HttpFoundation\ResponseInterface;
use AndreySerdjuk\HttpKernel\ExceptionEvent;

class ExceptionEventTest
{
    public function testResponseAccessors()
    {
        $event = new ExceptionEvent(
            'test',
            new Request(
                RequestInterface::METHOD_GET,
                '/asdf',
                [],
                [],
                [],
                [],
                []
            ),
            new \RuntimeException()
        );

        $event->setResponse(new JsonReponse());

        \assert($event->getResponse() instanceof ResponseInterface);
    }
}
