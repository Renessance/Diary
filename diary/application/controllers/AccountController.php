<?php
declare(strict_types=1);

namespace application\controllers;

use application\core\Controller;

class AccountController extends Controller
{

    public function loginAction()
    {

        if (!empty($_POST)) {

            if (!$this->model->validate(['login', 'password'], $_POST)) {
                $this->view->message('error', $this->model->error);
            } elseif (!$this->model->checkEmailExists($_POST['email'])) {
                $this->view->message('error', 'Email incorrect');
            } elseif (!$this->model->checkData($_POST['login'], $_POST['password'])) {
                $this->view->message('error', 'Login or Password incorrect');
            }

            $this->model->login($_POST['login']);

            if ($_SESSION['user']['familyMembers'] == "Father") {
                $this->view->location('main/father');
            }
            if ($_SESSION['user']['familyMembers'] == "Mother") {
                $this->view->location('main/mother');
            }
            if ($_SESSION['user']['familyMembers'] == "Child") {
                $this->view->location('main/child');
            }
        }

        $this->view->renderHtml('Login');
    }

    public function registerAction()
    {
        if (!empty($_POST)) {
            if (!$this->model->validate(['email', 'password', 'login'],
                $_POST)
            ) {
                $this->view->message('error', $this->model->error);
            } elseif ($this->model->checkEmailExists($_POST['email'])) {
                $this->view->message('error', 'This E-mail already used');
            }
            $this->model->register($_POST);
            $this->view->location('account/login');
        }

        $this->view->renderHtml('Registration');

    }

    public function logoutAction()
    {
        unset($_SESSION['user']);
        $this->view->redirect('account/login');
    }

}