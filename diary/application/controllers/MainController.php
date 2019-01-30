<?php
declare(strict_types=1);

namespace application\controllers;

use application\core\Controller;


class MainController extends Controller
{

    public function indexAction()
    {
        $result = $this->model->allTasks();
        $vars = [
            'tasks' => $result,
        ];
        $this->view->renderHtml('Diary', $vars);

    }

    public function fatherAction()
    {
        $result = $this->model->allTasks();
        $vars = [
            'tasks' => $result,
        ];
        $this->view->render('Father page', $vars);
    }

    public function MotherAction()
    {
        if (!empty($_POST)) {
            $this->model->store($_POST);
            $this->view->location('main/mother');
        }

        $result = $this->model->allTasks();
        $vars = [
            'tasks' => $result,
        ];

        $this->view->render('Mother page', $vars);

    }

    public function childAction()
    {
        $result = $this->model->allTasks();
        $vars = [
            'tasks' => $result,
        ];
        $this->view->render('Child page', $vars);
    }

    public function deleteAction()
    {
        $id = $this->route['id'];
        $result = $this->model->delete($id);
        $this->view->redirect('main/father');
    }


    public function editAction()
    {
        $id = $this->route['id'];
        $result = $this->model->db->getOne('tasks', $id);
        $this->model->notId($id, $result);

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
            $this->view->location('main/father');
        }
        $this->view->render('Edit task', $vars);

    }

    public function showAction()
    {
        $id = $this->route['id'];
        $result = $this->model->show($id);
        $this->model->notId($id, $result);
        $vars = [
            'oneTask' => $result,
        ];

        if (!empty($_POST)) {
            $params = [
                "id" => $id,
                "title" => $_POST['title'],
            ];

            $this->model->update($params);

            if ($_SESSION['user']['familyMembers'] == "Father") {
                $result = $this->view->location('main/father');

            }

            if ($_SESSION['user']['familyMembers'] == "Mother") {
                $this->view->location('main/mother');

            }

            if ($_SESSION['user']['familyMembers'] == "Child") {
                $this->view->location('main/child');

            }

        }

        $this->view->render('show', $vars);

    }

}