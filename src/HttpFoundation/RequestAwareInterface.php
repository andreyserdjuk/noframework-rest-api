<?php

namespace AndreySerdjuk\HttpFoundation;

interface RequestAwareInterface
{
    public function getRequest(): RequestInterface ;
}
