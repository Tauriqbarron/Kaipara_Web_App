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
    public $s_id;
    public $type;

    public function __construct($db){
        $this->conn = $db;
    }

    
    public function getClientBookings(){
        $query = 'SELECT 
            b.id,
            b.client_id,
            b.status,
            b.description,
            b.price,
            b.date,
            b.end_date,
            b.start_time,
            b.finish_time,
            b.street,
            b.suburb,
            b.city,
            t.description as type
        FROM
        ' . $this->table .' b
        JOIN 
            booking__types t ON b.booking_type_id = t.id
        WHERE
            client_id = ?';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1,$this->client_id);
        $stmt->execute();
        return $stmt;
    }
        public function getStaffBookings(){
        $query = 'SELECT
            b.id,
            b.date,
            b.end_date,
            b.description,
            b.start_time,
            b.finish_time,
            b.street,
            b.suburb,
            t.description as type,
            c.first_name as fname,
            c.last_name as lname,
            c.phone_number as number,
            g.id as staff_id
        From
            ' . $this->table .' b
        JOIN
            booking__types t ON b.booking_type_id = t.id
        JOIN
            clients c ON b.client_id = c.id
        JOIN
            staff__assignments s ON s.booking_id = b.id
        JOIN
            staff g ON s.staff_id = g.id
        Where 
            g.id = ?';
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1,$this->s_id);
    $stmt->execute();
    return $stmt;

    }
}
