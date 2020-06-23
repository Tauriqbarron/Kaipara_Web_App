<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: applications/json');

include_once '../../config/Database.php';
include_once '../../models/Staff.php';

$database = new Database();
$db = $database->connect();

$staff = new Staff($db);

if(isset($_GET['email'])){
    $staff->email = $_GET['email'];
}else{
    echo json_encode(
        array('message'=>'email not set')
    );
}


$result = $staff->getId();
$num = $result->rowCount();


if($num > 0 ){
    $staff_arr = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $staff_item = array(
            'id'=>$id,
        );
        array_push($staff_arr,$staff_item);
    }
    echo json_encode($staff_arr);
}else{
    echo josn_encode(
        array('message'=>'No Applications Found')
    );
}