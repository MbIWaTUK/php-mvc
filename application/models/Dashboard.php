<?php

namespace application\models;

use application\core\Model;
class Dashboard extends Model{

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

    public function request($post) {
            $params = [
                'id' => NULL,
                'name' => $post['name'],
                'surname' => $post['surname'],
                'age' => $post ['age'],
                'status' => '1'
            ];
            $this->db->query('INSERT INTO users VALUES ( :id, :name, :surname, :age, :status)', $params);
            return $this->db->lastInsertId();
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
}
