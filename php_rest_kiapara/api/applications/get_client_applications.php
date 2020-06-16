<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: applications/json');

include_once '../../config/Database.php';
include_once '../../models/Applications.php';

$database = new Database();
$db = $database->connect();

$applications = new Applications($db);
if(isset($_GET['id'])){
    $applications->client_id = $_GET['id'];
}else{
    echo json_encode(
        array('message'=>'id not set')
    );
}
$result = $applications->getClientApplications();
$num = $result->rowCount();

if($num > 0 ){
    $applications_arr = array();
    $applications_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $applications_item = array(
            'id'=>$id,
            'client_id'=>$client_id,
            'title'=>$title,
            'description'=>$description,
            'status'=>$status,
            'imagePath'=>$imagePath,
            'price'=>$price,
            'date'=>$date,
            'start_time'=>$start_time,
            'finish_time'=>$finish_time,
            'street'=>$street,
            'suburb'=>$suburb,
            'city'=>$city,
            'postcode'=>$postcode
        );
        array_push($applications_arr['data'],$applications_item);
    }
    echo json_encode($applications_arr);
}else{
    echo josn_encode(
        array('message'=>'No Applications Found')
    );
}

