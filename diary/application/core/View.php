<?php
declare(strict_types=1);

namespace application\core;

class View
{

    protected $path;

    protected $route;

    public $layout = 'default';

    public function __construct(array $route)
    {
        $this->route = $route;
        $this->path = $route['controller'] . '/' . $route['action'];
    }

    public function render(string $title, array $vars = [])
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

    public function renderHtml(string $title, array $vars = [])
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

    public function redirect(string $url)
    {
        header('location: /' . $url);
        exit;
    }

    public function message(string $status, string $message): string
    {
        exit(json_encode(['status' => $status, 'message' => $message]));
    }

    public function location(string $url)
    {
        exit(json_encode(['url' => $url]));
    }

}