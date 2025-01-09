<?php

namespace App\core\config;


require_once dirname(__DIR__, 3) . "\\vendor\\autoload.php";

use App\core\config\Connection;
use App\entities\Role;
use App\entities\User;

Class Crud{

    private $connection;
    
    public function __construct()
    {
        $this->connection = new Connection;
    }

    /////////////////////////////////////////////////// READ ///////////////////////////////////////////////////

    public function getAll($table) {
        $arrayIds = $this->fetchAllIds($table); 
        $array = [];

        foreach ($arrayIds as $id) {
            $element = $this->getOne($table, $id);
            if ($element) {
                $array[] = $element;
            }
        }

        return $array;
    }

    private function fetchAllIds($table) {
        $query = "SELECT id FROM {$table}";
        $result = $this->connection->prepare($query);
        $result->execute();

        $ids = [];
        while ($row = $result->fetch()) {
            $ids[] = $row['id'];
        }

        return $ids;
    }
  
    public function getOne($table, $id) {
        $query = "SELECT * FROM {$table} WHERE id = :id";
        $result = $this->connection->prepare($query);
        $result->bindParam(':id', $id);
        $result->execute();

        return $result->fetchObject();
    }

    public function getNumber($table){
        $query = "SELECT COUNT(*) FROM {$table}";
        $result = $this->connection->prepare($query);
        $result->execute();

        return $result->fetchColumn();
    }

    public function getAllby($table, $column, $value){
        $query = "SELECT COUNT(*) FROM {$table} WHERE {$column} = :{$column}";
        $result = $this->connection->prepare($query);
        $result->bindParam(':'.$column, $value);
        $result->execute();

        $number = $result->fetchColumn();
        $array = [];
        for ($i=1; $i < $number; $i++) { 
            $array[] = $this->getby($table, $column, $i);
        }

        return $array;
    }
    public function getby($table, $column, $value){
        $query = "SELECT * FROM {$table} WHERE {$column} = :{$column}";
        $result = $this->connection->prepare($query);
        $result->bindParam(':'.$column, $value);
        $result->execute();

        return $result->fetchObject();
    }

    public function create($table, User $user){
        $query = "INSERT INTO {$table} VALUES(NULL, :name, :prenom, :mail, :password, :role)";
        $result = $this->connection->prepare($query);

        $name = $user->getProperty("name");
        $prenom = $user->getProperty("prenom");
        $mail = $user->getProperty("mail");
        $password = $user->getProperty("password");
        $role = $user->getProperty("role")->getProperty("id");

        $result->bindParam(':name', $name);
        $result->bindParam(':prenom', $prenom);
        $result->bindParam(':mail', $mail);
        $result->bindParam(':password', $password);
        $result->bindParam(':role', $role);
        $result->execute();

        return true;
    }


    /////////////////////////////////////////////////// DELETE ///////////////////////////////////////////////////

    public function deleteBy($table, $column, $value){
        $result =  $this->getby($table, $column, $value);
        
        if($result) {
            $query = "DELETE FROM {$table} WHERE {$column} = :{$column}";
            $result = $this->connection->prepare($query);
            $result->bindParam(':'.$column, $value);
            $result->execute();
        } else {
            return "User Not Found";
        }
    }

}

$crud = new Crud;
$user = new User;
// $action = $_GET['action'] || null;

if(isset($_GET["action"]) && $_GET["action"] == "delete"){
    $id = $_GET['id'];
    $table = $_GET['table'];

    switch ($_GET["action"]) {
        case 'delete':
            {
                $crud->deleteBy($table, "id", $id);
            }
            break;
    }

} else if(isset($_POST["submitCreate"])){
    
    var_dump($_POST);

    foreach ($_POST as $key => $value) {
        if($key == "role"){
            $role = new Role;
            $objectRole = $crud->getOne("roles", $value);
            $role->initiateRole($objectRole->id, $objectRole->name);
            $user->setProperty($key, $role);
        } else {
            $user->setProperty($key, $value);
        }
        
    }

    if($crud->create("users", $user)){
        echo "Iserted element Success";
    } else {
        echo "failed";
    }

    if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }

}




?>