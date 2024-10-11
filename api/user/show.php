<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    
    include_once('../../config/db.php');
    include_once('../../model/user.php');

    $db = new db();
    $connect = $db->connect();

    $user = new user($connect);
    
    $user->id_user = isset($_GET['id']) ? $_GET['id'] : die();
    $user->show();
    $user_item = array(
        'id' => $user->id_user,
        'name' => $user->name,
        'phone' => $user->phone,
        'email' => $user->email,
        'password'=> $user->password
    );
    print_r(json_encode($user_item, JSON_PRETTY_PRINT));
?>