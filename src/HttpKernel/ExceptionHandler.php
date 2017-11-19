<?php

namespace AndreySerdjuk\HttpKernel;

use AndreySerdjuk\EventDispatcher\EventInterface;
use AndreySerdjuk\EventDispatcher\EventListenerInterface;
use AndreySerdjuk\HttpFoundation\JsonReponse;
use AndreySerdjuk\HttpFoundation\ResponseInterface;
use AndreySerdjuk\HttpKernel\Exception\HttpExceptionInterface;
use AndreySerdjuk\HttpKernel\Exception\UnauthenticatedException;
use AndreySerdjuk\HttpKernel\Exception\UnauthorizedException;

class ExceptionHandler implements EventListenerInterface
{
    public function call(EventInterface $event): void
    {
        if ($event instanceof ExceptionEvent) {
            $exception = $event->getException();
            $code = ResponseInterface::HTTP_INTERNAL_SERVER_ERROR;
            if ($exception instanceof HttpExceptionInterface) {
                $code = $exception->getHttpCode();
            }

            $headers = [];
            if ($exception instanceof UnauthenticatedException ||
                $exception instanceof UnauthorizedException
            ) {
                $headers['WWW-Authenticate'] = sprintf('Basic realm="%s"', 'main');
                $code = ResponseInterface::HTTP_UNAUTHORIZED;
            }

            $response = new JsonReponse(
                [
                    'message' => sprintf('Internal error: "%s".', $exception->getMessage()),
                ],
                $code,
                $headers
            );

            $event->setResponse($response);
        }
    }
}
