<?php

namespace AndreySerdjuk\EventDispatcher;

class Event implements EventInterface
{
    /** @var  string */
    protected $name;

    /** @var  bool */
    protected $stoppedPropagation = false;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function isPropagationStopped(): bool
    {
        return $this->stoppedPropagation;
    }

    public function stopPropagation(): void
    {
        $this->stoppedPropagation = true;
    }
}
