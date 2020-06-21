<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: applications/json');

include_once '../../config/Database.php';
include_once '../../models/ServiceProvider.php';

$database = new Database();
$db = $database->connect();

$serviceprovider = new ServiceProvider($db);

if(isset($_GET['email'])){
    $serviceprovider->email = $_GET['email'];
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

$serviceprovider->login();

if (password_verify($passCheck,$serviceprovider->password)){
    echo json_encode(
   array('message'=>'Pass')
);
}else{
   echo json_encode(
   array('message'=>'=Fail')
);
}
