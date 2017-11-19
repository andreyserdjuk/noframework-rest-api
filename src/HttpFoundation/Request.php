<?php

namespace AndreySerdjuk\HttpFoundation;

class Request implements RequestInterface
{
    /**
     * @var string
     */
    protected $method;

    /**
     * @var string
     */
    protected $path;

    /**
     * @var array
     */
    protected $queryParams;

    /**
     * @var array
     */
    protected $requestParams;

    /**
     * @var array
     */
    protected $cookies;

    /**
     * @var array
     */
    protected $headers;

    /**
     * @var array
     */
    protected $serverParams;

    /**
     * @var string
     */
    protected $content;

    public function __construct(
        string $method,
        string $path,
        array $queryParams,
        array $requestParams,
        array $cookies,
        array $headers,
        array $serverParams,
        string $content = null
    ) {
        $this->method = $method;
        $this->path = $path;
        $this->queryParams = $queryParams;
        $this->requestParams = $requestParams;
        $this->cookies = $cookies;
        $this->headers = $headers;
        $this->serverParams = $serverParams;
        $this->content = $content;
    }

    public static function fromGlobals(): self
    {
        return new self(
            $_SERVER['REQUEST_METHOD'],
            $_SERVER['PATH_INFO'] ?? '',
            $_GET,
            $_POST,
            $_COOKIE,
            getallheaders(),
            array_filter(
                $_SERVER,
                function ($key) {
                    return 0 !== strpos($key, 'HTTP_');
                },
                ARRAY_FILTER_USE_KEY
            )
        );
    }

    public function getContent(): string
    {
        if (null === $this->content) {
            $this->content = file_get_contents('php://input');
        }

        return $this->content;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getQueryParams(): array
    {
        return $this->queryParams;
    }

    public function getRequestParams(): array
    {
        return $this->requestParams;
    }

    public function getServerParams(): array
    {
        return $this->serverParams;
    }

    public function getCookies(): array
    {
        return $this->cookies;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }
}
