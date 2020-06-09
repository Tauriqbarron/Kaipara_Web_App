<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: applications/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Client.php';

$database = new Database();
$db = $database->connect();

$client = new Client($db);

$data = json_decode(file_get_contents('php://input'));

$client->id = $data->id; 


if($client->delete()){
    echo json_encode(
        array('message'=>'Client Deleted Successfully')
    );
}else{
    echo json_encode(
        array('message'=>'Client Deletion Failed')
    );
}