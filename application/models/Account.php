<?php

namespace application\models;

use application\core\Model;

class Account extends Model {

    public function validate($input, $post) {
        $rules = [
            'email' => [
                'pattern' => '#^([a-z0-9_.-]{1,20}+)@([a-z0-9_.-]+)\.([a-z\.]{2,10})$#',
                'message' => 'E-mail адрес указан неверно',
            ],
            'login' => [
                'pattern' => '/^[A-zА-яЁё0-9]{3,15}$/u',
                'message' => 'Логин указан неверно (Введите от 3 до 15 символов)',
            ],
            'password' => [
                'pattern' => '/^[A-zА-яЁё0-9]{3,30}$/u',
                'message' => 'Пароль указан неверно (Введите от 3 до 15 символов)',
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

    public function checkLogin($login){
        $params = [
            'login' => $login
        ];
        if($this->db->column('SELECT id FROM accounts WHERE login = :login', $params)){
            $this->error = 'Логин занят';
            return false;
        }
        return true;
    }

    public function checkEmail($email){
        $params = [
            'email' => $email
        ];
        if($this->db->column('SELECT id FROM accounts WHERE email = :email', $params)){
            $this->error = 'Почта занята';
            return false;
        }
        return true;
    }

    public function checkToken($token) {
        $params = [
            'token' => $token,
        ];
        return $this->db->column('SELECT id FROM accounts WHERE token = :token', $params);
    }

    public function activate($token) {
        $params = [
            'token' => $token,
        ];
        $this->db->query('UPDATE accounts SET status = 1, token = "" WHERE token = :token', $params);
    }


    public function createToken() {
        return substr(str_shuffle(str_repeat('0123456789abcdefghijklmnopqrstuvwxyz', 30)), 0, 30);
    }

    public function register($post) {
        $token = $this->createToken();
        $params = [
            'id' => NULL,
            'email' => $post['email'],
            'login' => $post['login'],
            'password' => password_hash($post['password'], PASSWORD_BCRYPT),
            'token' => $token,
            'status' => 0,
        ];
        $this->db->query('INSERT INTO accounts VALUES ( :id, :email, :login, :password, :token , :status)', $params);
        mail($post['email'], 'Register', 'Для подтверждения почты перейдите по ссылке: '.$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].'/account/confirm/'.$token);
    }

    public function checkData($login, $password){
        $params = [
            'login' => $login
        ];
        $hash = $this->db->column('SELECT password FROM accounts WHERE login = :login', $params);
        if (!$hash or !password_verify($password, $hash)){
            return false;
        }
        return true;
    }

    public function checkStatus($type, $data) {
        $params = [
            $type => $data,
        ];
        $status = $this->db->column('SELECT status FROM accounts WHERE '.$type.' = :'.$type, $params);
        if ($status != 1) {
            $this->error = 'Аккаунт ожидает подтверждения по E-mail';
            return false;
        }
        return true;
    }

    public function login($login) {
        $params = [
          'login' => $login
        ];
        $data = $this->db->row('SELECT * FROM accounts WHERE login = :login', $params);
        $_SESSION['account'] = $data[0];
    }

    public function save($post){
        $params = [
          'id'=> $_SESSION['account']['id']
        ];
        if(!empty($post['password'])){
            $params['password'] = password_hash($post['password'], PASSWORD_BCRYPT);
            $sql = 'password = :password';
        }else{
            $sql = '';
        }
        foreach ($params as $key => $val) {
            $_SESSION['account'][$key] = $val;
        }
        $this->db->query('UPDATE accounts SET '.$sql.' WHERE id = :id', $params);
    }

    public function recovery($post) {
        $token = $this->createToken();
        $params = [
            'email' => $post['email'],
            'token' => $token,
        ];
        $this->db->query('UPDATE accounts SET token = :token WHERE email = :email', $params);
        mail($post['email'], 'Recovery', 'Для получения пароля пройдите по ссылке: '.$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].'/account/reset/'.$token);
    }

    public function reset($token) {
        $new_password = $this->createToken();
        $params = [
            'token' => $token,
            'password' => password_hash($new_password, PASSWORD_BCRYPT),
        ];
        $this->db->query('UPDATE accounts SET status = 1, token = "", password = :password WHERE token = :token', $params);
        return $new_password;
    }
}