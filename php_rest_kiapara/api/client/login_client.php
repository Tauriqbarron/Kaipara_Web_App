<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: applications/json');

include_once '../../config/Database.php';
include_once '../../models/Client.php';

$database = new Database();
$db = $database->connect();

$client = new Client($db);


if(isset($_GET['email'])){
    $client->id = $_GET['email'];
}else{
    echo json_encode(
        array('message'=>'id not set')
    );
}


$client->login();

$client_pass = $client->password;

print(json_encode($client_pass));