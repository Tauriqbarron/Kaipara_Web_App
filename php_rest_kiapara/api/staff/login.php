<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: applications/json');

include_once '../../config/Database.php';
include_once '../../models/Staff.php';

$database = new Database();
$db = $database->connect();

$staff = new Staff($db);

if(isset($_GET['email'])){
    $staff->email = $_GET['email'];
}else{
    echo json_encode(
        array('message'=>'email not set')
    );
}

if(isset($_GET['password'])){
    $passCheck = $_GET['password'];
     
}else{
    echo json_encode(
        array('message'=>'password not set')
    );
}

$staff->login();

if (password_verify($passCheck,$staff->password)){
    echo json_encode(
   array('message'=>'Pass')
);
}else{
   echo json_encode(
   array('message'=>'=Fail')
);
}
