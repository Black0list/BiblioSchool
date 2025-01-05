<?php

namespace App\entities;

use App\core\config\Connection;

class User {

    private $id;
    private $name;
    private $prenom;
    private $mail;
    private $password;
    private $role;
    private $connection;

    public function __construct($id, $name, $prenom, $mail, $password, $role)
    {
        $this->connection = new Connection;
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
}
