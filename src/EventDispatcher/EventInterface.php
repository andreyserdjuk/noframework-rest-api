<?php

namespace AndreySerdjuk\EventDispatcher;

interface EventInterface
{
    public function getName(): string ;

    public function isPropagationStopped(): bool ;

    public function stopPropagation(): void;
}
