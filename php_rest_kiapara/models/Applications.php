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
    public $fname;
    public $lname;
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
        applications.client_id,
        applications.status,
        applications.imagePath,
        applications.title,
        applications.description,
        applications.price,
        applications.date,
        applications.street,
        applications.suburb,
        applications.city,
        clients.first_name,
        clients.last_name,
        clients.phone_number
    FROM
    ' . $this->table .' p
    LEFT JOIN 
        clients ON applications.client_id = clients.id
    WHERE 
        status = 1
    ORDER BY p.date';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}
