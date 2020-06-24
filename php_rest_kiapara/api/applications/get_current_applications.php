<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: applications/json');

include_once '../../config/Database.php';
include_once '../../models/Applications.php';

$database = new Database();
$db = $database->connect();


if(isset($_GET['id'])){
    $applications->s_id = $_GET['id'];
}else{
    echo json_encode(
        array('message'=>'id not set')
    );
}

$applications = new Applications($db);
$result = $applications->getCurrentApplications();


$num = $result->rowCount();


if($num > 0){
    $applications_arr = array();

 while($row = $result->fetch(PDO::FETCH_ASSOC)){
    extract($row);
    $applications_item = array(
        'title'=>$title,
        'description'=>$description,
        'status'=>$status,
        'imagePath'=>$imagePath,
        'price'=>$price,
        'date'=>$date,
        'street'=>$street,
        'suburb'=>$suburb,
        'city'=>$city,
        'end_date'=>$end_date,
        'first_name'=>$fname,
        'last_name'=>$lname,
        'phone_number'=>$number
    );
    array_push($applications_arr['data'],$applications_item);
 }
 echo json_encode($applications_arr);
}else{
    echo josn_encode(
        array('message'=>'No Applications Found')
    );
}


