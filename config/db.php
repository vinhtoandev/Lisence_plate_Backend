<?php


class db
{
    private $servername = 'localhost:3307';
    private $username = 'root';
    private $password = '';
    private $db = 'license_plate';
    private $conn;
    public function connect()
    {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->servername . ";dbname=" . $this->db, $this->username, $this->password);
            // set the PDO error mode to exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
        }
        return $this->conn;
    }
}
