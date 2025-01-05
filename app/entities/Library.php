<?php

namespace App\entities;

use App\core\config\Connection;
use App\entities\User;

class Library {

    private $connection;

    public function __construct() {
        $this->connection = new Connection();
    }

    public function getAllUsers() {
        $userIds = $this->fetchAllUserIds(); 
        $users = [];

        foreach ($userIds as $id) {
            $user = $this->getOneUser($id);
            if ($user) {
                $users[] = $user;
            }
        }

        return $users;
    }

    private function fetchAllUserIds() {
        $query = "SELECT id FROM users";
        $result = $this->connection->prepare($query);
        $result->execute();

        $ids = [];
        while ($row = $result->fetch()) {
            $ids[] = $row['id'];
        }

        return $ids;
    }

    public function getOneUser($id) {
        $query = "SELECT * FROM users WHERE id = :id";
        $result = $this->connection->prepare($query);
        $result->bindParam(':id', $id);
        $result->execute();

        $row = $result->fetch();

        if ($row) {
            return new User(
                $row['id'],
                $row['name'],
                $row['prenom'],
                $row['mail'],
                $row['password'],
                $row['role']
            );
        }

        return null;
    }

    public function getNumberOfUsers(){
        $query = "SELECT COUNT(*) FROM users";
        $result = $this->connection->prepare($query);
        $result->execute();

        $Number = $result->fetchColumn();

        return $Number;
    }
}