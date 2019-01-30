<?php
declare(strict_types=1);

namespace application\core;

use application\core\View;

abstract class Controller
{

    protected $route;

    protected $view;

    protected $acl;

    public function __construct(array $route)
    {

        $this->route = $route;
        if (!$this->checkAcl()) {
            View::errorCode(403);
        }
        $this->view = new View($route);
        $this->model = $this->loadModel($route['controller']);
    }


    public function loadModel($name)
    {
        $path = 'application\models\\' . ucfirst($name);
        if (class_exists($path)) {
            return new $path;
        } else {
            throw new Exception("Model not found");
        }
    }


    public function checkAcl()
    {
        $this->acl = require 'application/acl/' . $this->route['controller']
            . '.php';
        if ($this->isAcl('all')) {
            return true;
        } elseif ($_SESSION['user']['familyMembers'] == 'Father' and $this->isAcl('accessFather')) {
            return true;
        } elseif ($_SESSION['user']['familyMembers'] == 'Mother' and $this->isAcl('accessMother')) {
            return true;
        } elseif ($_SESSION['user']['familyMembers'] == 'Child' and $this->isAcl('accessChild')) {
            return true;
        }
        if ($_SESSION['admin'] and $this->isAcl('admin')) {
            return true;

        }
        throw new \Exception("You do not have access rights", 404);
        
    }

    public function isAcl(string $key)
    {
        return in_array($this->route['action'], $this->acl[$key]);
    }

}