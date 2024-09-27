<?php

// dbconnect.php
class Database {
    private $server = 'localhost:3306';
    private $database = 'task-25-09';
    private $username = 'root';
    private $password = '';
    public $conn;

    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = $conn = mysqli_connect($this->server, $this->username, $this->password, $this->database);

        } catch (Exception $e) {
            echo "Connection error: " . $e->getMessage();
        }

        return $this->conn;
    }
}


?>
