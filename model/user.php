<?php
    class user{
        private $conn;
        public $id_user;
        public $name;
        public $phone;
        public $email;
        public $password;
        public function __construct($db){
            $this->conn = $db;
        }
        public function read() {
            $query = "SELECT * FROM user";  // Thay 'users' bằng tên bảng phù hợp
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }
        public function show() {
            $query = "SELECT * FROM user WHERE id_user = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $this->id_user);
            $stmt->execute();
        
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
            $this->id_user = $row['id_user'];
            $this->name = $row['name'];
            $this->phone = $row['phone'];
            $this->email = $row['email'];
            $this->password = $row['password'];
        }
        public function show_all() {
            $query = "SELECT * FROM user";  // Thay 'users' bằng tên bảng phù hợp
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }
        public function create(){
            $query = "INSERT INTO user SET name=:name, phone=:phone, email=:email, password=:password";
            $stmt = $this->conn->prepare($query);

            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->phone = htmlspecialchars(strip_tags($this->phone));
            $this->email = htmlspecialchars(strip_tags($this->email));
            $this->password = htmlspecialchars(strip_tags($this->password));

            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':phone', $this->phone);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':password', $this->password);

            if($stmt->execute()){
                return true;
            }
            printf("error %s".$stmt->error);
            return false;
        }
        public function update(){
            $query = "UPDATE user SET name=:name, phone=:phone, email=:email, password=:password WHERE id_user=:id_user";
            $stmt = $this->conn->prepare($query);

            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->phone = htmlspecialchars(strip_tags($this->phone));
            $this->email = htmlspecialchars(strip_tags($this->email));
            $this->password = htmlspecialchars(strip_tags($this->password));
            $this->id_user = htmlspecialchars(strip_tags($this->id_user));

            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':phone', $this->phone);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':password', $this->password);
            $stmt->bindParam(':id_user', $this->id_user);

            if($stmt->execute()){
                return true;
            }
            printf("error %s".$stmt->error);
            return false;


        }
        public function delete(){
            $query = "DELETE FROM user WHERE id_user=:id_user";
            $stmt = $this->conn->prepare($query);

            $this->id_user = htmlspecialchars(strip_tags($this->id_user));
            $stmt->bindParam(':id_user', $this->id_user);
            if($stmt->execute()){
                return true;
            }
            printf("error %s".$stmt->error);
            return false;


        }
    }

?>