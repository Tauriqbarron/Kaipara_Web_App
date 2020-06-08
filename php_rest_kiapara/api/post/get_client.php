<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: applications/json');

include_once '../../config/Database.php';
include_once '../../models/Client.php';

$database = new Database();
$db = $database->connect();

$client = new Client($db);

$result = $client->getClient();

$num = $result->rowCount();

if($num > 0){
    $client_arr = array();
    $client_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $client_item = array(
            'id'=>$id,
            'created_at'=> $created_at,
            'updated_at'=> $updated_at,
            'first_name'=> $firstname,
            'last_name'=> $lastname,
            'email'=> $email,
            'phone_number'=> $phone_number,
            'password'=> $password,
            'street' => $street,
            'suburb'=> $suburb,
            'city' => $city,
            'postcode' => $postcode
        );
        array_push($client_arr['data'],$client_item);
    }
    echo json_encode($service_arr);
}else{
    echo json_encode(
        array('message'=>'No Cleints Found')
    );
}
