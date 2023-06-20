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
            $this->database = new PDO('mysql:host=' . $_ENV["DB_HOST"] . ';dbname=' . $_ENV["DB_NAME"] . ';charset=utf8', $_ENV["DB_USERNAME"], $_ENV["DB_PASSWORD"]);
            $this->database->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $this->database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return $this->database;
    }
}