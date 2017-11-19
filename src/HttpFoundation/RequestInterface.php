<?php

namespace AndreySerdjuk\HttpFoundation;

interface RequestInterface
{
    public const METHOD_HEAD = 'HEAD';
    public const METHOD_GET = 'GET';
    public const METHOD_POST = 'POST';
    public const METHOD_PUT = 'PUT';
    public const METHOD_PATCH = 'PATCH';
    public const METHOD_DELETE = 'DELETE';
    public const METHOD_PURGE = 'PURGE';
    public const METHOD_OPTIONS = 'OPTIONS';
    public const METHOD_TRACE = 'TRACE';
    public const METHOD_CONNECT = 'CONNECT';

    public function getMethod(): string ;

    public function getPath(): string;

    public function getHeaders(): array ;

    public function getQueryParams(): array ;

    public function getRequestParams(): array ;

    public function getServerParams(): array ;

    public function getCookies(): array ;

    public function getContent(): ?string ;
}
