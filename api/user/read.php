<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    
    include_once('../../config/db.php');
    include_once('../../model/Question.php');

    $db = new db();
    $connect = $db->connect();

    $question = new Question($connect);
    $read = $question->read();

    $num = $read->rowCount(); // Số lượng dòng kết quả

    if($num > 0) {
        $question_array = [];
        $question_array['data'] = [];

        // Lặp qua từng dòng dữ liệu
        while($row = $read->fetch(PDO::FETCH_ASSOC)) { // Sửa $num->fetch thành $read->fetch
            extract($row); // Tạo biến tương ứng với từng cột

            // Tạo mảng dữ liệu câu hỏi
            $question_item = array(
                'id' => $id,
                'name' => $name,
                'slug' => $slug,
                'status' => $status
            );
            array_push($question_array['data'], $question_item); // Thêm từng dòng vào mảng kết quả
        }
        echo json_encode($question_array, JSON_PRETTY_PRINT);
    }
  
?>