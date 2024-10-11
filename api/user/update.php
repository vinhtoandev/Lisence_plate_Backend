<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers:Access-Control-Allow-Headers, Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');


    include_once('../../config/db.php');
    include_once('../../model/user.php');

    $db = new db();
    $connect = $db->connect();

    $user = new user($connect);
    
    $data = json_decode(file_get_contents("php://input"));
    $user->id_user= $data->id_user;
    $user->name = $data->name;
    $user->phone = $data->phone;
    $user->email = $data->email;
    $user->password = $data->password;

    if($user->update()){
        echo json_encode(array('message', 'updated'));
    }
    else{
        echo json_encode(array('message', 'not'));
    }
  
?>