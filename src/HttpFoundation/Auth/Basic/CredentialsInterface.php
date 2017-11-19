<?php

namespace AndreySerdjuk\HttpFoundation\Auth\Basic;

/**
 * Declares basic auth credentials model.
 */
interface CredentialsInterface
{
    public function getUser(): string ;

    public function getPassword(): string ;
}
