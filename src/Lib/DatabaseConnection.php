<?php

namespace Lib;

use PDO;

require_once(__DIR__ . '/../config.php');

class DatabaseConnection
{
    private ?PDO $database = null;

    public function getConnection(): PDO
    {
        if ($this->database === null) {
            $this->database = new PDO('mysql:host=localhost;dbname=bdd_blogpro;charset=utf8', $_ENV["USERNAME_DB"], $_ENV["PASSWORD_DB"]);
        }

        return $this->database;
    }
}