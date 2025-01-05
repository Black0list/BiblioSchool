<?php

namespace App\core\config;

$autoloadPath = dirname(__DIR__, 3) . DIRECTORY_SEPARATOR . "vendor" . DIRECTORY_SEPARATOR . "autoload.php";
include_once $autoloadPath;

use Dotenv\Dotenv;
use PDO;
use PDOException;

$dotenv = Dotenv::createImmutable(dirname(__DIR__, 3));
$dotenv->load();

class Connection {
    private $connection;

    public function __construct() {
        $this->connection = null;

        try {
            $dsn = $_ENV['DB_DSN'] . ";host=" . $_ENV['DB_HOST'] . ";port=" . $_ENV['DB_PORT'] . ";dbname=" . $_ENV['DB_DATABASE'];
            $this->connection = new PDO($dsn, $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD']);
        } catch (PDOException $exception) {
            die("Connection error: " . $exception->getMessage());
        }
    }

    public function getConnection() {
        return $this->connection;
    }

    public function prepare($query) {
        return $this->getConnection()->prepare($query);
    }
}