<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once('../../config/db.php');
include_once('../../model/car.php');

$db = new db();
$connect = $db->connect();


$car = new car($connect);


$car->id_car = isset($_GET['id']) ? $_GET['id'] : die();

$car->show();


$car_item = array(
    'id_car' => $car->id_car,
    'license_plate' => $car->license_plate,
    'type' => $car->type,
    'inTime' => $car->inTime,
    'outTime' => $car->outTime,
    'id_user' => $car->id_user
);


print_r(json_encode($car_item));
