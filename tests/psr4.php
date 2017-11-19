<?php

spl_autoload_register(function($class) {
    $rootNamespace = 'AndreySerdjuk\\Tests';

    if (0 === strpos($class, $rootNamespace)) {
        $path = str_replace($rootNamespace, '', $class);
        $path = ltrim($path, '\\');
        $path = __DIR__.'/'.str_replace('\\', '/', $path).'.php';
        if (file_exists($path)) {
            include_once $path;
        }
    }
});
