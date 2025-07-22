<?php
require_once __DIR__ . '/../env.php';
class DataBase
{
    private $host = DB_HOST;
    private $username = DB_USER;
    private $password = DB_PASSWORD;
    private $database = DB_NAME;

    private $connection;
    public function __construct()
    {
        $this->dbconnection();
    }

    private function dbconnection()
    {
        $conn = new mysqli($this->host, $this->username, $this->password, $this->database);

        if ($conn->connect_error) {
            die("unable to connect");
        } else {
            // echo "all good";
            $this->connection = $conn;
        }
    }

    public function getconnection()
    {
        return $this->connection;
    }
}
