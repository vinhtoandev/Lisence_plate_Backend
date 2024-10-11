<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    
    include_once('../../config/db.php');
    include_once('../../model/Question.php');

    $db = new db();
    $connect = $db->connect();

    $question = new Question($connect);
    
    $question->id = isset($_GET['id']) ? $_GET['id'] : die();
    $question->show();
    $question_item = array(
        'id' => $question->id,
        'name' => $question->name,
        'slug' => $question->slug,
        'status' => $question->status
    );
    print_r(json_encode($question_item))
?>