<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: applications/json');

include_once '../../config/Database.php';
include_once '../../models/Applications.php';

$database = new Database();
$db = $database->connect();

$applications = new Applications($db);
$result = $applications->getAvailableApplications();

$num = $result->rowCount();

if($num > 0 ){
    $applications_arr = array();

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
            'phone_number'=>$number,
            'first_name'=>$fname,
            'last_name'=>$lname
        );
        array_push($applications_arr,$applications_item);
    }
    echo json_encode($applications_arr);
}else{
    echo josn_encode(
        array('message'=>'No Applications Found')
    );
}
