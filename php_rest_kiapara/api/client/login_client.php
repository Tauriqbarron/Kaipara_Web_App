<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: applications/json');

include_once '../../config/Database.php';
include_once '../../models/Client.php';

$database = new Database();
$db = $database->connect();

$client = new Client($db);


if(isset($_GET['email'])){
    $client->email = $_GET['email'];
}else{
    echo json_encode(
        array('message'=>'email not set')
    );
}
if(isset($_GET['password'])){
    $passCheck = password_hash($_GET['password'],PASSWORD_BCRYPT);
     
}else{
    echo json_encode(
        array('message'=>'password not set')
    );
}



$client->getSingleClient();



if ($client->password == $passCheck){
    print("true");
}else{
    print("Does not match );
}

