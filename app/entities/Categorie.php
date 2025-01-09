<?php

namespace App\entities;

use App\core\config\Connection;

Class Categorie
{

    private $id;
    private $name;
    private $connection;
    private $books = [];

    public function __construct()
    {
        $connection = new Connection;
    }

    public function initiateCategory($id, $name, Book $books){
        $this->id = $id;
        $this->name = $name;
        $this->books[] = $books;
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