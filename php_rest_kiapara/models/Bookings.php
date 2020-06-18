<?php

class Bookings{
    private $conn;
    private $table = 'bookings';
    private $id;
    private $client_id;
    private $description;
    private $status;
    private $price;
    private $date;
    private $end_date;
    private $start_time;
    private $finish_time;
    private $street;
    private $suburb;
    private $city;

    public function __construct($db){
        $this->conn = $db;
    }

    public function getClientBookings(){
        $query = 'SELECT 
            id,
            client_id,
            status,
            description,
            price,
            date,
            end_date,
            start_time,
            finish_time,
            street,
            suburb,
            city,
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