<?php
declare(strict_types=1);

namespace application\core;

class View
{

    protected $path;

    protected $route;

    public $layout = 'default';

    public function __construct($route)
    {
        $this->route = $route;
        $this->path = $route['controller'] . '/' . $route['action'];
    }

    public function render($title, $vars = [])
    {
        extract($vars);
        $path = 'application/views/' . $this->path . '.php';
        if (file_exists($path)) {
            ob_start();
            require $path;
            $content = ob_get_clean();
            require 'application/views/layouts/' . $this->layout . '.php';
        }
    }

    public function renderHtml($title, $vars = [])
    {
        extract($vars);
        $path = 'application/views/' . $this->path . '.html';
        if (file_exists($path)) {
            ob_start();
            require $path;
            $content = ob_get_clean();
            require 'application/views/layouts/' . $this->layout . '.php';
        }
    }

    public function redirect($url)
    {
        header('location: /' . $url);
        exit;
    }

    public function message(string $status, string $message): string
    {
        exit(json_encode(['status' => $status, 'message' => $message]));
    }

    public function location($url)
    {
        exit(json_encode(['url' => $url]));
    }

}