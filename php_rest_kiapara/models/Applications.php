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
    public $end_date;
    public $street;
    public $suburb;
    public $city;
    public $postcode;
    public $start_time;
    public $finish_time;
    public $fname;
    public $lname
    public $number;
    

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
            end_date,
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
            end_date,
            street,
            suburb,
            city,
            postcode
        FROM
        ' . $this->table .'
        WHERE 
            client_id = ?';    
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1,$this->client_id);
        $stmt->execute();
        return $stmt;    
    }
        public function getAvailableApplications(){
        $query = 'SELECT 
        p.id,
        p.client_id,
        p.status,
        p.imagePath,
        p.title,
        p.description,
        p.price,
        p.date,
        p.start_time,
        p.finish_time,
        p.street,
        p.suburb,
        p.city,
        c.fname as first_name,
        c.lname as last_name,
        c.number as phone_number

    FROM
    ' . $this->table .' p
    LEFT JOIN 
        clients c ON p.client_id = c.id
    WHERE 
        status = 1';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}
