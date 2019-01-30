<?php
declare(strict_types=1);

namespace application\core;

define("DEBUG", 1);

class ErrorHandler
{

    public function __construct()
    {
        if (DEBUG) {
            error_reporting(-1);
        } else {
            error_reporting(0);
        }
        set_exception_handler([$this, 'exceptionHandler']);
    }

    public function exceptionHandler($e)
    {
        $this->displayError('Exception', $e->getMessage(), $e->getFile(),
            $e->getLine(), $e->getCode());
    }

    protected function displayError(
        $errno,
        $errstr,
        $errfile,
        $errline,
        $responce = 404
    ) {
        http_response_code($responce);
        if ($responce == 404 && !DEBUG) {
            require 'application/views/errors/404.php';
            die;
        }
        if (DEBUG) {
            require 'application/views/errors/dev.php';
        }
        die;
    }

}