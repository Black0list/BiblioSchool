<?php

namespace App\entities;

use App\core\config\Connection;

Class Book 
{

    private $id;
    private $title;
    private $author;
    private $type;
    // private $tags = [];
    private $connection;


    public function __construct()
    {
        $this->connection = new Connection;
    }

    public function initiateBook($id, $title, $author, $type)
    {
        $this->id = $id;
        $this->title = $title;
        $this->author = $author;
        $this->type = $type;
        // $this->tags[] = $tags;
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