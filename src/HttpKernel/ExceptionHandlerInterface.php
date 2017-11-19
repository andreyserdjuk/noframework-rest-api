<?php

namespace AndreySerdjuk\HttpKernel;

interface ExceptionHandlerInterface
{
    public function handle(ExceptionEvent $event);
}
