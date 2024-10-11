<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    
    include_once('../../config/db.php');
    include_once('../../model/user.php');

    $db = new db();
    $connect = $db->connect();

    $user = new user($connect);
    $read = $user->read();

    $num = $read->rowCount(); // Số lượng dòng kết quả

    if($num > 0) {
        $user_array = [];
        $user_array['data'] = [];

        // Lặp qua từng dòng dữ liệu
        while($row = $read->fetch(PDO::FETCH_ASSOC)) { // Sửa $num->fetch thành $read->fetch
            extract($row); // Tạo biến tương ứng với từng cột

            // Tạo mảng dữ liệu câu hỏi
            $user_item = array(
                'id' => $id_user,  // Đảm bảo đúng với tên cột trong DB
                'name' => $name,
                'phone' => $phone,
                'email' => $email,
                'password' => $password
            );
            array_push($user_array['data'], $user_item); // Thêm từng dòng vào mảng kết quả
        }
        echo json_encode($user_array, JSON_PRETTY_PRINT);
    }
  
?>