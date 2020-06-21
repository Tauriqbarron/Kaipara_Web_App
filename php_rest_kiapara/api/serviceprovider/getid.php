<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: applications/json');

include_once '../../config/Database.php';
include_once '../../models/ServiceProvider.php';

$database = new Database();
$db = $database->connect();

$service = new ServiceProvider($db);
if(isset($_GET['email'])){
    $service->client_id = $_GET['email'];
}else{
    echo json_encode(
        array('message'=>'email not set')
    );
}



$result = $service->getId();
$num = $result->rowCount();

if($num > 0 ){
    $service_arr = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $service_item = array(
            'id'=>$id,
        );
        array_push($service_arr,$service_item);
    }
    echo json_encode($service_arr);
}else{
    echo josn_encode(
        array('message'=>'No Applications Found')
    );
}