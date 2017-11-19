<?php

namespace AndreySerdjuk\HttpKernel;

final class Events
{
    public const AUTHENTICATION = 'http_kernel.authentication';
    public const AUTHORIZATION = 'http_kernel.authorization';
    public const GET_CONTROLLER = 'http_kernel.get_controller';
    public const HANDLING_EXCEPTION = 'http_kernel.handling_exception';
}
