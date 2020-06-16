<?php

class Applications{
    private $conn;
    private $table = 'applications';
    private $id;
    private $client_id;
    private $title;
    private $description;
    private $status;
    private $imagepath;
    private $price;
    private $date;
    private $start_time;
    private $finish_time;
    private $street;
    private $suburb;
    private $city;
    private $postcode;

    public function __construct($db){
        $this->conn = $db;
    }

    public function getApplications(){
        $query = 'SELECT 
            id,
            client_id,
            status,
            imagePath,
            title,
            description,
            price,
            date,
            start_time,
            finish_time,
            street,
            suburb,
            city,
            postcode
        FROM
        ' . $this->table .'';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}