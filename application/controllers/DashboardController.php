<?php

namespace application\controllers;

use application\core\Controller;
use application\lib\Pagination;
use application\models\admin;

class DashboardController extends Controller{

    public function listAction() {
        $pagination = new Pagination($this->route, $this->model->userCount());
        $vars = [
            'pagination' => $pagination->get(),
            'list' => $this->model->userList($this->route),
        ];
        $this->view->render('Список', $vars);
    }

    public function historyAction() {
        //
    }

    public function requestAction() {
        if (!empty($_POST)) {
            if (!$this->model->validate(['name', 'surname', 'age'], $_POST)) {
                $this->view->message('error', $this->model->error);
            }
            $id = $this->model->request($_POST);
            if(!$id) {
                $this->view->message('error', 'Ошибка обработки');
            }
            $this->view->message('success', 'Запись добавлена');
        }
        $this->view->render('Заявка');
    }
}