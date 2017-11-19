<?php

namespace AndreySerdjuk\HttpFoundation\Auth\Basic;

use AndreySerdjuk\HttpFoundation\RequestInterface;

/**
 * {@inheritdoc}
 */
class Credentials implements CredentialsInterface
{
    /**
     * @var string
     */
    protected $user;

    /**
     * @var string
     */
    protected $password;

    public function __construct(string $user, string $password)
    {
        $this->user = $user;
        $this->password = $password;
    }

    public static function fromRequest(RequestInterface $request): self
    {
        return new self(
            $request->getServerParams()['PHP_AUTH_USER'] ?? '',
            $request->getServerParams()['PHP_AUTH_PW'] ?? ''
        );
    }

    public function getUser(): string
    {
        return $this->user;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
