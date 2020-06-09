<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: applications/json');

include_once '../../config/Database.php';
include_once '../../models/Client.php';

$database = new Database();
$db = $database->connect();

$client = new Client($db);

$client->id = isset($__GET['id']) ? $__GET['id'] : die();

$client->getSingleClient();

$client_arr = array(
    'id'=> $client->id,
    'created_at'=> $client->created_at,
    'updated_at'=> $client->updated_at,
    'first_name'=> $client->first_name,
    'last_name'=> $client->last_name,
    'email'=> $client->email,
    'phone_number'=> $client->phone_number,
    'password'=> $client->password,
    'street'=> $client->street,
    'suburb'=> $client->suburb,
    'city'=> $client->city,
    'postcode'=> $client->postcode
);

print_r(json_encode($client_arr));