<?php
declare(strict_types=1);

namespace application\models;

use application\core\Model;

class Admin extends Model
{

    public function loginValidate($post)
    {
        $config = require 'application/config/admin.php';
        if ($config['email'] != $post['email'] or $config['password']
            != $post['password']
        ) {
            $this->error = 'Login or Password incorrect';
            return false;
        }
        return true;
    }


    public function allTasks()
    {
        $result = $this->db->all('tasks');
        return $result;
    }

    public function create($post)
    {

        $params = [
            'title' => $post['title'],
            'content' => $post['content'],
            'familyMembers' => $post['familyMembers'],
        ];
        $this->db->store('tasks', $params);
    }


    public function validate($input, $post)
    {
        $rules = [
            'email' => [
                'pattern' => '#^([a-z0-9_.-]{1,20}+)@([a-z0-9_.-]+)\.([a-z\.]{2,10})$#',
                'message' => 'E-mail incorrect',
            ],

            'login' => [
                'pattern' => '#^[a-z0-9]{3,15}$#',
                'message' => 'Login incorrect (Only Latin letters and numbers from 3 to 15 characters are allowed',
            ],

            'password' => [
                'pattern' => '#^[a-z0-9]{5,30}$#',
                'message' => 'Password incorrect (Only Latin letters and numbers from 3 to 15 characters are allowed',

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

    public function checkEmailExists($email)
    {
        $params = [
            'email' => $email,
        ];
        return $this->db->column('SELECT id FROM users WHERE email = :email',
            $params);
    }


    public function createUser($post)
    {

        $params = [
            'email' => $post['email'],
            'login' => $post['login'],
            'password' => password_hash($post['password'], PASSWORD_BCRYPT),
            'familyMembers' => $post['familyMembers'],
        ];
        $this->db->store('users', $params);
    }

    public function updateUser($params)
    {

        $this->db->query('UPDATE users SET email = :email, login = :login, familyMembers = :familyMembers WHERE id = :id',
            $params);
    }

    public function delete($id)
    {
        $this->db->delete('tasks', $id);
    }

    public function deleteUser($id)
    {
        $this->db->delete('users', $id);

    }

    public function allUsers()
    {
        $result = $this->db->all('users');
        return $result;
    }

    public function show($id)
    {
        $result = $this->db->getOne('tasks', $id);
        return $result;
    }

    public function update($params)
    {

        $this->db->query('UPDATE tasks SET title = :title, familyMembers = :familyMembers WHERE id = :id',
            $params);
    }

    public function updateShow($params)
    {

        $this->db->query('UPDATE tasks SET title = :title  WHERE id = :id',
            $params);
    }


}