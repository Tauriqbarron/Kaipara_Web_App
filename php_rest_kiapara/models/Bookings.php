<?php

class Bookings{
    private $conn;
    private $table = 'bookings';
    public $id;
    public $client_id;
    public $description;
    public $status;
    public $price;
    public $date;
    public $end_date;
    public $start_time;
    public $finish_time;
    public $street;
    public $suburb;
    public $city;

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
