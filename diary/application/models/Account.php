<?php
declare(strict_types=1);

namespace application\models;

use application\core\Model;

class Account extends Model
{

    public function validate(array $input,array $post)
    {
        $rules = [
            'email' => [
                'pattern' => '#^([a-z0-9_.-]{1,20}+)@([a-z0-9_.-]+)\.([a-z\.]{2,10})$#',
                'message' => 'E-mail incorrect',
            ],

            'login' => [
                'pattern' => '#^[a-z0-9]{3,15}$#',
                'message' => 'Login not correct (Only Latin letters and numbers from 3 to 15 characters are allowed.',
            ],

            'password' => [
                'pattern' => '#^[a-z0-9]{5,30}$#',
                'message' => 'Пароль указан неверно (Only Latin letters and numbers from 10 to 30 characters are allowed.',

            ],
        ];


        foreach ($input as $val) {
            if (!isset($post[$val]) or !preg_match($rules[$val]['pattern'],
                    $post[$val])
            ) {
                $this->error = $rules[$val]['message'];
                return false;
            }
        }

        return true;
    }

    public function checkEmailExists(string $email)
    {
        $params = [
            'email' => $email,
        ];
        return $this->db->column('SELECT id FROM users WHERE email = :email',
            $params);
    }

    public function checkData(string $login, string $password)
    {
        $params = [
            'login' => $login,
        ];
        $hash = $this->db->column('SELECT password FROM users WHERE login = :login',
            $params);
        if (!$hash or !password_verify($password, $hash)) {
            return false;
        }
        return true;
    }


    public function register(array $post)
    {

        $params = [
            'email' => $post['email'],
            'login' => $post['login'],
            'password' => password_hash($post['password'], PASSWORD_BCRYPT),
            'familyMembers' => $post['familyMembers'],
        ];
        $this->db->store('users', $params);
    }

    public function login(string $login)
    {
        $params = [
            'login' => $login,
        ];
        $data = $this->db->row('SELECT * FROM users WHERE login = :login',
            $params);
        $_SESSION['user'] = $data[0];
    }

}