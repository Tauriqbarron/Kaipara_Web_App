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
            city
        FROM
        ' . $this->table .'
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
            b.description,
            b.start_time,
            b.finish_time,
            b.street,
            b.suburb,
            t.description as type,
            c.first_name as fname,
            c.last_name as lname,
            c.phone_number as number
        From
            ' . $this->table .' b
        JOIN
            booking__types t ON b.booking_type_id = t.id
        JOIN
            clients c ON b.client_id = c.id
       JOIN
            staff__assignments s ON b.id = s.staff_id
        WHERE
            b.id = ?
        AND
            b.id = s.staff_id
        ORDER BY b.start_time';
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1,$this->id);
    $stmt->execute();
    return $stmt;

    }
}
