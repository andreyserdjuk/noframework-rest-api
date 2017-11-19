<?php

use AndreySerdjuk\Tests\EventDispatcher\EventDispatcherTest;

require __DIR__.'/../autoload/psr4.php';
require __DIR__.'/psr4.php';

$excEventTest = new \AndreySerdjuk\Tests\HttpKernel\ExceptionEventTest();
$excEventTest->testResponseAccessors();

$eventDispatcherTest = new EventDispatcherTest();
$eventDispatcherTest->testDispatchOrder();