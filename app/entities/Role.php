<?php

namespace App\entities;

use App\core\config\Connection;
use PDO;

Class Role {

    private $id;
    private $name;
    private $connection;

    public function __construct()
    {
        $this->connection = new Connection;
    }

    public function initiateRole($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function getProperty($propertyName){
            return $this->$propertyName;
    }

    public function setProperty($propertyName, $value){
        $this->$propertyName = $value;
    }
}