<?php

namespace application\controllers;

use application\core\Controller;
use application\lib\Pagination;
use application\models\Main;

class AdminController extends Controller {


    public function __construct($route) {
        parent::__construct($route);
        $this->view->layout = 'admin';
    }

    public function loginAction() {
        if (isset($_SESSION['admin'])) {
            $this->view->redirect('admin/add');
        }
        if (!empty($_POST)) {
            if (!$this->model->loginValidate($_POST)) {
                $this->view->message('error', $this->model->error);
            }
            $_SESSION['admin'] = true;
            $this->view->location('admin/add');
        }
        $this->view->render('Вход');
    }

    public function logoutAction() {
        unset($_SESSION['admin']);
        $this->view->redirect('admin/login');
    }

    public function addAction() {
        if (!empty($_POST)) {
            if (!$this->model->validate(['name', 'surname', 'age'], $_POST)) {
                $this->view->message('error', $this->model->error);
            }
            $id = $this->model->addUsers($_POST);
            if(!$id) {
                $this->view->message('error', 'Ошибка обработки');
            }
            $this->view->message('success', 'Запись добавлена');
        }
        $this->view->render('Добавить юзера');
    }

    public function tableAction() {
            $result = $this->model->upLoadUsers($_POST);
            $vars = $result;
            $this->view->render('table', $vars);
    }

    public function usersAction() {
        $pagination = new Pagination($this->route, $this->model->userCount());
        $vars = [
            'pagination' => $pagination->get(),
            'list' => $this->model->userList($this->route),
        ];
        $this->view->render('Список юзеров', $vars);
    }

    public function updateAction(){
        if (!$this->model->isUserExists($this->route['id'])) {
            $this->view->errorCode(404);
        }
        if (!empty($_POST)) {
            if (!$this->model->Validate(['name', 'surname', 'age'], $_POST)) {
                $this->view->message('error', $this->model->error);
            }
            $this->model->updateUser($_POST, $this->route['id']);
            $this->view->message('success', 'Сохранено');
        }

        $vars = [
            'data' => $this->model->dataUser($this->route['id'])[0],
        ];
        $this->view->render('Редактировать пост', $vars);
    }

    public function deleteAction() {
        if (!$this->model->isUserExists($this->route['id'])) {
            $this->view->errorCode(404);
        }
        $this->model->deleteUsers($this->route['id']);
        $this->view->redirect('admin/users');
    }

    public function requestAction() {
        $pagination = new Pagination($this->route, $this->model->requestCount());
        $vars = [
            'pagination' => $pagination->get(),
            'list' => $this->model->requestList($this->route),
        ];
        $this->view->render('Список на добавление', $vars);
    }

    public function addRequestAction() {
        if (!$this->model->isUserExists($this->route['id'])) {
            $this->view->errorCode(404);
        }
            $this->model->requestAdd($this->route['id']);
            $this->view->redirect('admin/request');
    }

    public function rejectAction() {
        if (!$this->model->isUserExists($this->route['id'])) {
            $this->view->errorCode(404);
        }
        $this->model->requestReject($this->route['id']);
        $this->view->redirect('admin/request');
    }
}