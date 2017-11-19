<?php

namespace AndreySerdjuk\HttpFoundation;

class Response implements ResponseInterface
{
    /** @var  string */
    protected $content;

    /** @var  string */
    protected $statusCode;

    /** @var  array */
    protected $headers;

    /** @var  string */
    protected $version;

    public function __construct(
        string $content = '',
        string $statusCode = self::HTTP_OK,
        array $headers = [],
        string $version = self::VERSION_11
    ) {
        $this->content = $content;
        $this->statusCode = $statusCode;
        $this->headers = $headers;
        $this->version = $version;
    }

    public function getVersion(): string
    {
        return $this->version;
    }

    public function setVersion(string $version): Response
    {
        $this->version = $version;

        return $this;
    }

    public function getStatusCode(): string
    {
        return $this->statusCode;
    }

    public function setStatusCode(string $statusCode): Response
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function setHeaders(array $headers): Response
    {
        $this->headers = $headers;

        return $this;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): Response
    {
        $this->content = $content;

        return $this;
    }

    public function send(): void
    {
        if (headers_sent()) {
            return;
        }

        foreach ($this->headers as $name => $value) {
            header($name.': '.$value, false, $this->statusCode);
        }

        header(
            sprintf(
                'HTTP/%s %s %s',
                $this->version,
                $this->statusCode,
                self::STATUS_TEXTS[$this->statusCode]
            ),
            true,
            $this->statusCode
        );

        echo $this->content;
    }
}
