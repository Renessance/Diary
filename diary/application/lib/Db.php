<?php
declare(strict_types=1);

namespace application\lib;

use PDO;

class Db
{

    protected $db;

    public function __construct()
    {
        $config = require 'application/config/db.php';
        $this->db = new PDO('mysql:host=' . $config['host'] . ';dbname='
            . $config['name'] . '', $config['user'], $config['password']);
    }

    public function query(string $sql, array $params = [])
    {
        $stmt = $this->db->prepare($sql);
        if (!empty($params)) {
            foreach ($params as $key => $val) {
                $stmt->bindValue(':' . $key, $val);
            }
        }
        $stmt->execute();

        return $stmt;
    }

    public function row(string $sql, array $params = [])
    {
        $result = $this->query($sql, $params);

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function column(string $sql, array $params = [])
    {
        $result = $this->query($sql, $params);

        return $result->fetchColumn();
    }


    public function all(string $table)
    {
        $sql = "SELECT * FROM $table";
        $statement = $this->db->prepare($sql);
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }

    public function getOne(string $table, int $id)
    {
        $sql = "SELECT * FROM $table WHERE id=:id";
        $statement = $this->db->prepare($sql);
        $statement->bindParam(":id", $id);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    public function store(string $table, array $data)
    {

        $keys = array_keys($data);
        $stringOfKeys = implode(',', $keys);
        $placeholders = ":" . implode(', :', $keys);
        $sql = "INSERT INTO $table ($stringOfKeys) VALUES ($placeholders)";
        $statement = $this->db->prepare($sql);
        $statement->execute($data);
    }

    public function update(string $table, array $data)
    {
        $fields = '';

        foreach ($data as $key => $value) {
            $fields .= $key . "=:" . $key . ",";
        }

        $fields = rtrim($fields, ',');
        $sql = "UPDATE $table SET $fields WHERE id=:id";
        $statement = $this->db->prepare($sql);
        $statement->execute($data);
    }

    public function delete(string $table, int $id)
    {
        $sql = "DELETE FROM $table WHERE id=:id";
        $statement = $this->db->prepare($sql);
        $statement->bindParam(":id", $id);
        $statement->execute();
    }

}