<?php

namespace AndreySerdjuk\HttpKernel\Controller;

use AndreySerdjuk\HttpFoundation\RequestInterface;
use AndreySerdjuk\HttpKernel\Routing\MatchingRule;

class ControllerResolver implements ControllerResolverInterface
{
    /** @var  \SplObjectStorage */
    protected $rules;

    public function __construct()
    {
        $this->rules = new \SplObjectStorage;
    }

    public function addRuleToController(MatchingRule $matchingRule, callable $controller)
    {
        $this->rules[$matchingRule] = $controller;
    }

    public function resolve(RequestInterface $request): ?array
    {
        /**
         * @var MatchingRule $rule
         * @var callable $controller
         */
        foreach ($this->rules as $rule) {
            if ($rule->getMethod() === $request->getMethod() &&
                preg_match($rule->getPathRegex(), $request->getPath(), $matches)
            ) {
                return [$this->rules[$rule], $matches];
            }
        }

        return null;
    }
}
