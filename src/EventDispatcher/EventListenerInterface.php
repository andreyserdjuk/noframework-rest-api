<?php

namespace AndreySerdjuk\EventDispatcher;

interface EventListenerInterface
{
    public function call(EventInterface $event): void ;
}
