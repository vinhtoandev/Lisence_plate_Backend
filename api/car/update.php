<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');


include_once('../../config/db.php');
include_once('../../model/car.php');


$db = new db();
$connect = $db->connect();


$car = new car($connect);


$data = json_decode(file_get_contents("php://input"));


$car->id_car = $data->id_car;
$car->license_plate = $data->license_plate;
$car->type = $data->type;
$car->inTime = $data->inTime;
$car->id_user = $data->id_user;

if ($car->update()) {
    echo json_encode(array('message' => 'Car updated successfully'));
} else {
    echo json_encode(array('message' => 'Car update failed'));
}
