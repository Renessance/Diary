<?php
declare(strict_types=1);

namespace application\controllers;

use application\core\Controller;

class AdminController extends Controller
{

    public function __construct(array $route)
    {
        parent::__construct($route);
        $this->view->layout = 'admin';
    }

    public function loginAction()
    {
        if (isset($_SESSION['admin'])) {
            $this->view->redirect('admin/adminList');
        }
        if (!empty($_POST)) {
            if (!$this->model->loginValidate($_POST)) {
                $this->view->message('error', $this->model->error);
            }
            $_SESSION['admin'] = true;
            $this->view->location('admin/adminList');
        }
        $this->view->renderHtml('login');
    }


    public function logoutAction()
    {
        unset($_SESSION['admin']);
        $this->view->redirect('admin/login');
    }


    public function adminListAction()
    {
        $result = $this->model->allTasks();
        $vars = [
            'tasks' => $result,
        ];
        $this->view->render('Admin list', $vars);

    }


    public function createAction()
    {
        if (!empty($_POST)) {
            $this->model->create($_POST);
            $this->view->location('admin/create');
        }
        $result = $this->model->allTasks();
        $vars = [
            'tasks' => $result,
        ];
        $this->view->renderhtml('Create task', $vars);
    }


    public function controlUserAction()
    {
        if (!empty($_POST)) {
            if (!$this->model->validate(['email', 'password', 'login'], $_POST)) {
                $this->view->message('error', $this->model->error);
            } elseif ($this->model->checkEmailExists($_POST['email'])) {
                $this->view->message('error', 'Этот E-mail уже используется');
            }

            $this->model->createUser($_POST);
            $this->view->location('admin/controlUser');

        }

        $result = $this->model->allUsers();
        $vars = [
            'users' => $result,
        ];

        $this->view->render('Create user', $vars);

    }

    public function deleteAction()
    {
        $id = $this->route['id'];
        $this->model->delete($id);
        $this->view->redirect('admin/adminList');

    }

    public function deleteUserAction()
    {
        $id = $this->route['id'];
        $this->model->deleteUser($id);
        $this->view->redirect('admin/controlUser');

    }


    public function showAction()
    {
        $id = $this->route['id'];
        $result = $this->model->show($id);
        $vars = [
            'oneTask' => $result,
        ];

        if (!empty($_POST)) {
            $params = [
                "id" => $id,
                "title" => $_POST['title'],
            ];
            $this->model->updateShow($params);
            $this->view->location('admin/adminList');
        }

        $this->view->render('Show task', $vars);

    }


    public function editAction()
    {
        $id = $this->route['id'];
        $result = $this->model->db->getOne('tasks', $id);
        $vars = [
            'oneTask' => $result,
        ];

        if (!empty($_POST)) {
            $params = [
                "id" => $id,
                "title" => $_POST['title'],
                "content" => $_POST['content'],
                "familyMembers" => $_POST['familyMembers'],
            ];

            $this->model->db->update('tasks', $params);
            $this->view->location('admin/adminList');
        }

        $this->view->render('Edit task', $vars);

    }


}