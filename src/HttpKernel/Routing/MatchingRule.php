<?php

namespace AndreySerdjuk\HttpKernel\Routing;

class MatchingRule
{
    /** @var  string */
    protected $method;

    /** @var  string */
    protected $pathRegex;

    public function __construct($method, $pathRegex)
    {
        $this->method = $method;
        $this->pathRegex = $pathRegex;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getPathRegex(): string
    {
        return $this->pathRegex;
    }
}
