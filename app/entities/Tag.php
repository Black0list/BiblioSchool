<?php

namespace App\entities;

Class Categorie {

    private $id;
    private $name;
    private $books = [];

    public function __construct($id, $name, $books)
    {
        $this->id = $id;
        $this->name = $name;
        $this->books = $books;
        
    }

    public function getProperty($propertyName){
        return $this->$propertyName;
    }

    public function setProperty($propertyName, $value){
        $this->$propertyName = $value;
    }
}