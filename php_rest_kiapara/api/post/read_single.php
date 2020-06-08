<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: applications/json');

include_once '../../config/Database.php';
include_once '../../models/Services.php';

$database = new Database();
$db = $database->connect();

$service = new Services($db);


$service->id = isset($__GET['id']) ? $__GET['id'] : die();

$service->read_single();


$service_arr = array(
    'id'=> $service->id,
    'description'=> $service->description
);

print_r(json_encode($service_arr));