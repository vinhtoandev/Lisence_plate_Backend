<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once('../../config/db.php');
include_once('../../model/car.php');

$db = new db();
$connect = $db->connect();

$car = new Car($connect);
$read = $car->read();

$num = $read->rowCount();

if ($num > 0) {
    $car_array = [];
    $car_array['data'] = [];

    // Lặp qua từng dòng dữ liệu
    while ($row = $read->fetch(PDO::FETCH_ASSOC)) { // Sửa $num->fetch thành $read->fetch
        extract($row); // Tạo biến tương ứng với từng cột

        // Tạo mảng dữ liệu câu hỏi
        $car_item = array(
            'id_car' => $id_car,
            'license_plate' => $license_plate,
            'type' => $type,
            'inTime' => $inTime,
            'outTime' => $outTime,
            'id_user' => $id_user,
        );
        array_push($car_array['data'], $car_item); // Thêm từng dòng vào mảng kết quả
    }
    echo json_encode($car_array, JSON_PRETTY_PRINT);
}
