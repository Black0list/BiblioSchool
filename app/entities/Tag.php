<?php

namespace App\entities;

use App\core\config\Connection;
use App\core\config\Crud as ConfigCrud;

Class Tag {

    private $id;
    private $name;
    private $connection;
    private $books = [];

    public function __construct()
    {
        $this->connection = new Connection;
    }

    public function initiateTag($id, $name, $books){
        $this->id = $id;
        $this->name = $name;
        $this->books[] = $books;
    }
    public function getProperty($propertyName){
        return $this->$propertyName;
    }

    public function setProperty($propertyName, $value){
        $this->$propertyName = $value;
    }
}