<?php

namespace AndreySerdjuk;

use AndreySerdjuk\EventDispatcher\EventDispatcher;
use AndreySerdjuk\HttpFoundation\RequestInterface;
use AndreySerdjuk\HttpFoundation\ResponseInterface;
use AndreySerdjuk\HttpKernel\Controller\ControllerResolver;
use AndreySerdjuk\HttpKernel\Controller\ControllerResolvingListener;
use AndreySerdjuk\HttpKernel\Events;
use AndreySerdjuk\HttpKernel\ExceptionHandler;
use AndreySerdjuk\HttpKernel\Kernel;
use AndreySerdjuk\HttpKernel\RequestHandlerInterface;
use AndreySerdjuk\HttpKernel\Routing\MatchingRule;
use AndreySerdjuk\Security\Authentication\EntryPoint\BasicAuthEntryPoint;
use AndreySerdjuk\Security\AutorizationListener;
use AndreySerdjuk\Security\BasicAuthenticationListener;

class App implements RequestHandlerInterface
{
    /** @var  Kernel */
    protected $kernel;

    /** @var ControllerResolver */
    protected $controllerResolver;

    public function __construct()
    {
        $config = yaml_parse_file(__DIR__.'/../app/config/params.yml');
        if (!$config) {
            throw new \RuntimeException('Cannot load config file.');
        }
        $allowedUsers = $config['app']['users'];

        $this->controllerResolver = new ControllerResolver();
        $entryPoint = new BasicAuthEntryPoint('main', '/\/authenticate\/basic\/?/');

        $dispatcher = new EventDispatcher();
        $dispatcher
            ->addListener(
                Events::AUTHENTICATION,
                new BasicAuthenticationListener($entryPoint)
            )
            ->addListener(
                Events::AUTHORIZATION,
                new AutorizationListener($allowedUsers, $entryPoint)
            )
            ->addListener(
                Events::GET_CONTROLLER,
                new ControllerResolvingListener($this->controllerResolver)
            )
            ->addListener(
                Events::HANDLING_EXCEPTION,
                new ExceptionHandler()
            )
        ;

        $this->kernel = new Kernel($dispatcher);
// basic auth does not require auth page
//        $this->on(
//            RequestInterface::METHOD_GET,
//            $entryPoint->getRoute(),
//            new AuthenticationController($entryPoint)
//        );
    }

    public function handle(RequestInterface $request): ResponseInterface
    {
        return $this->kernel->handle($request);
    }

    public function on(string $method, string $pathRegex, callable $controller): self
    {
        $rule = new MatchingRule($method, $pathRegex);
        $this->controllerResolver->addRuleToController($rule, $controller);

        return $this;
    }
}
