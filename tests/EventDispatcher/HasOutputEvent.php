<?php

namespace AndreySerdjuk\Tests\EventDispatcher;

use AndreySerdjuk\EventDispatcher\Event;

class HasOutputEvent extends Event
{
    /** @var  string */
    protected $output = '';

    public function getOutput(): string
    {
        return $this->output;
    }

    public function setOutput(string $output)
    {
        $this->output = $output;
    }
}
