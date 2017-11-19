<?php

namespace AndreySerdjuk\EventDispatcher;

class EventDispatcher implements EventDispatcherInterface
{
    /** @var  EventListenerInterface[][] */
    protected $listeners = [];

    /** @var  array */
    protected $sortedListeners = [];

    public function dispatch(EventInterface $event): void
    {
        /**
         * @var EventListenerInterface[] $listenersByPriority
         */
        foreach ($this->getListeners($event->getName()) as $listenersByPriority) {
            foreach ($listenersByPriority as $listener) {
                if ($event->isPropagationStopped()) {
                    break;
                }
                $listener->call($event);
            }
        }
    }

    public function addListener(
        string $eventName,
        EventListenerInterface $listener,
        int $priority = 0
    ): EventDispatcherInterface
    {
        $this->listeners[$eventName][$priority][] = $listener;
        unset($this->sortedListeners[$eventName]);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getListeners(string $eventName): array
    {
        if (empty($this->listeners[$eventName])) {
            return [];
        }

        if (!isset($this->sortedListeners[$eventName])) {
            ksort($this->listeners[$eventName]);
            $this->sortedListeners[$eventName] = 1;
        }

        return $this->listeners[$eventName];
    }
}
