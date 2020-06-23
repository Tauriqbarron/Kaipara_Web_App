<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: applications/json');

include_once '../../config/Database.php';
include_once '../../models/Bookings.php';

$database = new Database();
$db = $database->connect();

$bookings = new Bookings($db);


if(isset($_GET['id'])){
    $bookings->id = $_GET['id'];
}else{
    echo json_encode(
        array('message'=>'id not set')
    );
}

$result = $bookings->getStaffBookings();

$num = $result->rowCount();

if($num > 0){
    $bookings_arr = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $bookings_item = array(
            'id'=>$id,
            'description'=>$description,
            'start_time'=>$start_time,
            'finish_time'=>$finish_time,
            'street'=>$street,
            'suburb'=>$suburb,
            'type'=>$type,
            'fname'=>$fname,
            'lname'=>$lname,
            'number'=>$number

        );
        array_push($bookings_arr,$bookings_item);
    }
    echo json_encode($bookings_arr);
}else{
    echo josn_encode(
        array('message'=>'No Bookings Found')
    );
}