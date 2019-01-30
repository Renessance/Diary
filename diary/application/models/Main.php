<?php
declare(strict_types=1);

namespace application\models;

use application\core\Model;


class Main extends Model
{

    public function allTasks()
    {
        $result = $this->db->all('tasks');
        return $result;

    }

    public function allId()
    {
        $result = $this->db->row('SELECT id FROM tasks');
        return $result;

    }

    public function store(array $post)
    {

        $params = [
            'title' => $post['title'],
            'content' => $post['content'],
            'familyMembers' => $post['familyMembers'],
        ];
        $this->db->store('tasks', $params);

    }

    public function show(int $id)
    {
        $result = $this->db->getOne('tasks', $id);
        return $result;
    }

    public function update(array $params)
    {

        $this->db->query('UPDATE tasks SET title = :title WHERE id = :id',
            $params);

    }

    public function delete(int $id)
    {
        $result = $this->db->delete('tasks', $id);

    }

    public function notId(int $id, $result)
    {

        if ($id != $result['id']) {
            throw new \Exception("id not found");
        }

    }

}