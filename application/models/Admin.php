<?php

namespace application\models;

use application\core\Model;

class Admin extends Model {


    public function userList($route)
    {
        $max = 3;
        $params = [
            'max' => $max,
            'start' => ((($route['page'] ?? 1) - 1) * $max),
            'status' => '0'
        ];
        return $this->db->row('SELECT * FROM users WHERE status = :status ORDER BY id DESC LIMIT :start, :max', $params);
    }

    public function userCount()
    {
        return $this->db->column('SELECT COUNT(id) FROM users WHERE status = "0"');
    }


    public function loginValidate($post) {
        $config = require 'application/config/admin.php';
        if ($config['login'] != $post['login'] or $config['password'] != $post['password']) {
            $this->error = 'Логин или пароль указан неверно';
            return false;
        }
        return true;
    }

    public function addUsers($post) {
        $params = [
            'id' => NULL,
            'name' => $post['name'],
            'surname' => $post['surname'],
            'age' => $post ['age'],
            'status' => '0'
        ];
        $this->db->query('INSERT INTO users VALUES ( :id, :name, :surname, :age, :status)', $params);
        return $this->db->lastInsertId();
    }

    public function upLoadUsers() {
        $result = $this->db->row('SELECT * FROM users WHERE age>17 ');
        return $result;
    }



    public function updateUser($post, $id) {
        $params = [
            'id' => $id,
            'name' => $post['name'],
            'surname' => $post['surname'],
            'age' => $post['age']
        ];
        $this->db->query('UPDATE users SET name = :name, surname = :surname, age = :age WHERE id = :id', $params);
    }

    public function dataUser($id) {
        $params = [
            'id' => $id,
        ];
        return $this->db->row('SELECT * FROM users WHERE id = :id', $params);
    }

    public function isUserExists($id) {
        $params = [
            'id' => $id,
        ];
        return $this->db->column('SELECT id FROM users WHERE id = :id', $params);
    }

    public function deleteUsers($id) {
        $params= [
            'id' => $id
        ];
        $this->db->query('DELETE FROM users WHERE id = :id' , $params);
    }


    public function validate($input, $post) {
        $rules = [
            'name' => [
                'pattern' => '/^[A-zА-яЁё]{3,15}$/u',
                'message' => 'Имя указано неверно (Введите от 3 до 15 символов)',
            ],
            'surname' => [
                'pattern' => '/^[A-zА-яЁё]{3,15}$/u',
                'message' => 'Фамилия указана неверно (Введите от 3 до 15 символов)',
            ],
            'age' => [
                'pattern' => '/^[0-9]{1,3}$/',
                'message' => 'Возраст указан неверно',
            ]
        ];
        foreach ($input as $val) {
            if (!isset($post[$val]) or !preg_match($rules[$val]['pattern'], $post[$val])) {
                $this->error = $rules[$val]['message'];
                return false;
            }
        }
        return true;
    }

    public function requestAdd( $id) {
        $params = [
            'id' => $id,
            'status' => '0'
        ];
        $this->db->query('UPDATE users SET status = :status WHERE id = :id', $params);
    }

    public function requestReject( $id) {
        $params = [
            'id' => $id,
            'status' => '2'
        ];
        $this->db->query('UPDATE users SET status = :status WHERE id = :id', $params);
    }


    public function requestList($route){
        $max = 3;
        $params = [
            'max' => $max,
            'start' => ((($route['page'] ?? 1) - 1) * $max),
            'status' => 1
        ];
        return $this->db->row('SELECT * FROM users WHERE status = :status ORDER BY id DESC LIMIT :start, :max', $params);
    }

    public function requestCount() {
        return $this->db->column('SELECT COUNT(id) FROM users WHERE status = "1" ');
    }
}
