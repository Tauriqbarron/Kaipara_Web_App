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
$staff_arr = array();

$staff_arr = array(
    'id'=> $staff->id
);

print_r(json_encode($staff_arr));
