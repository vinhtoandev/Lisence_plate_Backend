<?php
// Cấu hình header cho phép truy cập từ các nguồn khác và định dạng dữ liệu là JSON
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

// Kết nối cơ sở dữ liệu và bao gồm model `car`
include_once('../../config/db.php');
include_once('../../model/car.php');

// Khởi tạo kết nối tới database
$db = new db();
$connect = $db->connect();

// Khởi tạo đối tượng `car`
$car = new car($connect);

// Nhận dữ liệu được gửi đến từ yêu cầu DELETE (dưới dạng JSON)
$data = json_decode(file_get_contents("php://input"));

// Gán giá trị `id_car` từ dữ liệu nhận được
$car->id_car = $data->id_car;

// Thực hiện phương thức `delete()` để xóa bản ghi từ bảng `car`
if ($car->delete()) {
    echo json_encode(array('message' => 'Car deleted successfully'));
} else {
    echo json_encode(array('message' => 'Car deletion failed'));
}
