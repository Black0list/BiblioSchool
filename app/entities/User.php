<?php

namespace App\entities;

use App\core\config\Connection;
use App\core\config\Crud as ConfigCrud;

class User extends ConfigCrud{

    private $id;
    private $name;
    private $prenom;
    private $mail;
    private $password;
    private Role $role;
    private $connection;
    private $crud;

    public function __construct()
    {   
        $this->connection = new Connection();
        $this->connection->getConnection();

    }

    public function initiateUser($id, $name, $prenom, $mail, $password, Role $role){
        $this->id = $id;
        $this->name = $name;
        $this->prenom = $prenom;
        $this->mail = $mail;
        $this->password = $password;
        $this->role = $role;
    }

    public function getProperty($propertyName)
    {
        return $this->$propertyName;
    }

    public function setProperty($propertyName, $value)
    {
        $this->$propertyName = $value;
    }


    // public function getOne($table, $id) {
    //     $query = "SELECT * FROM {$table} WHERE id = :id";
    //     // var_dump($this->connection->getConnection());
    //     $result = $this->connection->prepare($query);
    //     $result->bindParam(':id', $id);
    //     $result->execute();

    //     return $result->fetchObject();
    // }













    // public function getAllUsers() {
    //     $userIds = $this->fetchAllUserIds(); 
    //     $users = [];

    //     foreach ($userIds as $id) {
    //         $user = $this->getOneUser($id);
    //         if ($user) {
    //             $users[] = $user;
    //         }
    //     }

    //     return $users;
    // }

    // private function fetchAllUserIds() {
    //     $query = "SELECT id FROM users";
    //     $result = $this->connection->prepare($query);
    //     $result->execute();

    //     $ids = [];
    //     while ($row = $result->fetch()) {
    //         $ids[] = $row['id'];
    //     }

    //     return $ids;
    // }

    // public function getOneUser($id) {
    //     $query = "SELECT * FROM users WHERE id = :id";
    //     $result = $this->connection->prepare($query);
    //     $result->bindParam(':id', $id);
    //     $result->execute();

    //     return $result->fetchObject();
    // }

    // public function getNumberOfUsers(){
    //     $query = "SELECT COUNT(*) FROM users";
    //     $result = $this->connection->prepare($query);
    //     $result->execute();

    //     return $result->fetchColumn();
    // }
}
