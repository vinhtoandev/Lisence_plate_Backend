<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    
    include_once('../../config/db.php');
    include_once('../../model/user.php');

    $db = new db();
    $connect = $db->connect();

    $user = new user($connect);
    
    // Gọi hàm để lấy tất cả các user
    $stmt = $user->show_all();

    // Kiểm tra nếu có bản ghi
    if ($stmt->rowCount() > 0) {
        $users_array = array();
        
        // Duyệt qua tất cả các user và thêm vào mảng
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // Trích xuất mảng kết hợp ($row)
            extract($row);

            // Định nghĩa từng user
            $user_item = array(
                'id' => $id_user,  // Đảm bảo đúng với tên cột trong DB
                'name' => $name,
                'phone' => $phone,
                'email' => $email,
                'password' => $password
            );

            // Thêm user vào mảng chính
            array_push($users_array, $user_item);
        }

        // In ra JSON đã được format đẹp
        
        print_r(json_encode($users_array, JSON_PRETTY_PRINT));
        
    } else {
        echo "No users found.";
    }

?>