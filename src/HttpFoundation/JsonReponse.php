<?php

namespace AndreySerdjuk\HttpFoundation;

class JsonReponse extends Response
{
    public function __construct(
        $content = '',
        $statusCode = self::HTTP_OK,
        array $headers = [],
        int $jsonOptions = 0,
        $version = self::VERSION_11
    ) {
        $headers['Content-Type'] = 'application/json';

        parent::__construct(
            json_encode($content, $jsonOptions),
            $statusCode,
            $headers,
            $version
        );
    }
}
