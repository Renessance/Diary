<?php
use application\core\Router;
use application\core\ErrorHandler;

spl_autoload_register(function ($class) {
    $path = str_replace('\\', '/', $class . '.php');
    if (file_exists($path)) {
        require $path;
    }
});

session_start();
$router = new Router;
$errors = new ErrorHandler;
$router->run();

