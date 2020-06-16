<?php

class Applications{
    private $conn;
    private $table = 'applications';
    public $id;
    public $client_id;
    public $title;
    public $description;
    public $status;
    public $imagepath;
    public $price;
    public $date;
    public $start_time;
    public $finish_time;
    public $street;
    public $suburb;
    public $city;
    public $postcode;

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
    public function getClientApplications(){
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
        ' . $this->table .'
        WHERE 
            client_id = ?';    
        $stmt = $this->conn->perpare($query);
        $stmt->bindParam(1,$this->client_id);
        $stmt->execute();
        return $stmt;    
    }
}
