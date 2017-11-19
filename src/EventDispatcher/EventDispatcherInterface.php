<?php

namespace AndreySerdjuk\EventDispatcher;

interface EventDispatcherInterface
{
    public function dispatch(EventInterface $event): void;

    public function addListener(string $eventName, EventListenerInterface $listener, int $priority = 0): EventDispatcherInterface;

    /**
     * @param string $eventName
     * @return EventListenerInterface[][]
     */
    public function getListeners(string $eventName): array;
}
