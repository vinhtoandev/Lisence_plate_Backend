<?php
    class Question{
        private $conn;
        public $id;
        public $name;
        public $slug;
        public $status;
        public function __construct($db){
            $this->conn = $db;
        }
        public function read() {
            $query = "SELECT * FROM brands";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }
        public function show() {
            $query = "SELECT * FROM brands WHERE id = ? LIMIT 1";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $this->id);
            $stmt->execute();
        
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
            $this->id = $row['id'];
            $this->name = $row['name'];
            $this->slug = $row['slug'];
            $this->status = $row['status'];
        }
    }

?>