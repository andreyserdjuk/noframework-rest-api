<?php

namespace AndreySerdjuk\Tests\EventDispatcher;

use AndreySerdjuk\EventDispatcher\EventDispatcher;
use AndreySerdjuk\EventDispatcher\EventInterface;
use AndreySerdjuk\EventDispatcher\EventListenerInterface;

class EventDispatcherTest
{
    public function testDispatchOrder()
    {
        $expectation = 'abc';

        $dispatcher = new EventDispatcher();

        $event = new HasOutputEvent('output_event');

        $dispatcher
            ->addListener(
                'output_event',
                new class implements EventListenerInterface {
                    public function call(EventInterface $event): void
                    {
                        if ($event instanceof HasOutputEvent) {
                            $event->setOutput($event->getOutput().'b');
                        }
                    }
                },
                2
            )
            ->addListener(
                'output_event',
                new class implements EventListenerInterface {
                    public function call(EventInterface $event): void
                    {
                        if ($event instanceof HasOutputEvent) {
                            $event->setOutput($event->getOutput().'a');
                        }
                    }
                },
                1
            )
            ->addListener(
                'output_event',
                new class implements EventListenerInterface {
                    public function call(EventInterface $event): void
                    {
                        if ($event instanceof HasOutputEvent) {
                            $event->setOutput($event->getOutput().'c');
                        }
                    }
                },
                3
            )
        ;

        $dispatcher->dispatch($event);
        $output = $event->getOutput();

        \assert(
            $expectation === $output,
            sprintf(
                'Event listeners call order is wrong. Expected: "%s", Got: "%s"',
                $expectation,
                $output
            )
        );
    }
}
