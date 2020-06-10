<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: applications/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,
Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Client.php';

$database = new Database();
$db = $database->connect();

$client = new Client($db);

$data = json_decode(file_get_contents("php://input"));

$client->first_name = $data->first_name;
$client->last_name = $data->last_name;
$client->email = $data->email;
$client->phone_number = $data->phone_number;
$client->password = password_hash($data->password,PASSWORD_DEFAULT);;
$client->street = $data->street;
$client->suburb = $data->suburb;
$client->city = $data->city;
$client->postcode = $data->postcode;

if($client->create()){
    echo json_encode(
        array('message'=>'Client Created Successfully')
    );
}else{
    echo json_encode(
        array('message'=>'Client creation Failed')
    );
}

