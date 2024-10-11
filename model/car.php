<?php
class Car
{
    private $conn;
    public $id_car;
    public $license_plate;
    public $type;
    public $inTime;
    public $outTime;
    public $id_user;

    public function __construct($db)
    {
        $this->conn = $db;
    }
    public function read()
    {
        $query = "SELECT * FROM car";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    public function show()
    {
        $query = "SELECT * FROM car WHERE id_car = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_car);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->id_car = $row['id_car'];
        $this->license_plate = $row['license_plate'];
        $this->type = $row['type'];
        $this->inTime = $row['inTime'];
        $this->outTime = $row['outTime'];
        $this->id_user = $row['id_user'];
    }
    public function create()
    {
        $query = "INSERT INTO car SET license_plate=:license_plate, type=:type, inTime=:inTime, outTime=:outTime, id_user=:id_user";

        $stmt = $this->conn->prepare($query);

        $this->license_plate = htmlspecialchars(strip_tags($this->license_plate));
        $this->type = htmlspecialchars(strip_tags($this->type));
        $this->inTime = htmlspecialchars(strip_tags($this->inTime));
        $this->outTime = htmlspecialchars(strip_tags($this->outTime));
        $this->id_user = htmlspecialchars(strip_tags($this->id_user));

        $stmt->bindParam(':license_plate', $this->license_plate);
        $stmt->bindParam(':type', $this->type);
        $stmt->bindParam(':inTime', $this->inTime);
        $stmt->bindParam(':outTime', $this->outTime);
        $stmt->bindParam(':id_user', $this->id_user);

        if ($stmt->execute()) {
            return true;
        }

        printf("Error: %s.\n", $stmt->error);
        return false;
    }
    public function update()
    {
        $query = "UPDATE car 
                  SET license_plate=:license_plate, type=:type, inTime=:inTime, outTime=:outTime, id_user=:id_user 
                  WHERE id_car=:id_car";
        $stmt = $this->conn->prepare($query);

        $this->license_plate = htmlspecialchars(strip_tags($this->license_plate));
        $this->type = htmlspecialchars(strip_tags($this->type));
        $this->inTime = htmlspecialchars(strip_tags($this->inTime));
        $this->outTime = htmlspecialchars(strip_tags($this->outTime));
        $this->id_user = htmlspecialchars(strip_tags($this->id_user));
        $this->id_car = htmlspecialchars(strip_tags($this->id_car));


        $stmt->bindParam(':license_plate', $this->license_plate);
        $stmt->bindParam(':type', $this->type);
        $stmt->bindParam(':inTime', $this->inTime);
        $stmt->bindParam(':outTime', $this->outTime);
        $stmt->bindParam(':id_user', $this->id_user);
        $stmt->bindParam(':id_car', $this->id_car);


        if ($stmt->execute()) {
            return true;
        }


        printf("Error: %s.\n", $stmt->error);
        return false;
    }
}
