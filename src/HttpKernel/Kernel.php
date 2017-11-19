<?php

namespace AndreySerdjuk\HttpKernel;

use AndreySerdjuk\Entity\Repository\BookRepository;
use AndreySerdjuk\EventDispatcher\EventDispatcherInterface;
use AndreySerdjuk\HttpFoundation\RequestInterface;
use AndreySerdjuk\HttpFoundation\ResponseInterface;
use AndreySerdjuk\HttpKernel\Exception\InternalErrorException;
use AndreySerdjuk\HttpKernel\Exception\NotFoundException;

class Kernel implements RequestHandlerInterface
{
    /** @var  EventDispatcherInterface */
    protected $eventDispatcher;

    /** @var  BookRepository */
    protected $bookRepository;

    public function __construct(
        EventDispatcherInterface $eventDispatcher
    ) {
        $this->eventDispatcher = $eventDispatcher;
        // just stub
        $this->bookRepository = new BookRepository();
    }

    public function handle(RequestInterface $request): ResponseInterface
    {
        try {
            foreach ([Events::AUTHENTICATION, Events::AUTHORIZATION] as $eventName) {
                $event = new GetResponseEvent($eventName, $request);
                $this->eventDispatcher->dispatch($event);
                if ($response = $event->getResponse()) {
                    return $response;
                }
            }

            $event = new GetControllerEvent(Events::GET_CONTROLLER, $request);
            $this->eventDispatcher->dispatch($event);
            if (!$controller = $event->getController()) {
                throw new NotFoundException(
                    sprintf(
                        'Cannot find controller for path "%s".',
                        $request->getPath()
                    )
                );
            }

            $response = $controller($request, $event->getArgs(), $this);

            if (!$response instanceof ResponseInterface) {
                throw new InternalErrorException(
                    sprintf(
                        'Controller should return "%s" instance, got "%s".',
                        ResponseInterface::class,
                        \get_class($response)
                    )
                );
            }
        } catch (\Throwable $e) {
            $event = new ExceptionEvent(Events::HANDLING_EXCEPTION, $request, $e);
            $this->eventDispatcher->dispatch($event);
            $response = $event->getResponse();
        }

        return $response;
    }

    public function getBookRepository(): BookRepository
    {
        return $this->bookRepository;
    }
}
