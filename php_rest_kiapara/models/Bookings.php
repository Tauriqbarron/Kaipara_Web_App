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
        $query = 'SELECT `bookings`.*, `booking__types`.`description`, `clients`.`first_name`, `staff__assignments`.`booking_id`, `staff__assignments`.`staff_id`, `staff`.`id`
FROM `bookings` 
	LEFT JOIN `booking__types` ON `bookings`.`booking_type_id` = `booking__types`.`id` 
	LEFT JOIN `clients` ON `bookings`.`client_id` = `clients`.`id` 
	LEFT JOIN `staff__assignments` ON `staff__assignments`.`booking_id` = `bookings`.`id` 
	LEFT JOIN `staff` ON `staff__assignments`.`staff_id` = `staff`.`id`
    WHERE staff.id = ?';
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1,$this->s_id);
    $stmt->execute();
    return $stmt;

    }
}
