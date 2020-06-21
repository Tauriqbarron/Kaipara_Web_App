<?php

class ServiceProvider{
    private $conn;
    private $table = 'service_providers';
    public $firstname;
    public $lastname;
    public $username;
    public $email;
    public $password;
    public $phonenumber;
    public $street;
    public $suburb;
    public $city;
    public $postcode;


    public function __construct($db){
        $this->conn = $db;
    }

    public function login(){
        $query = 'SELECT 
            password
        FROM
        ' . $this->table .'
        WHERE
            email = ?';
    
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1,$this->email);
        $stmt->execute();
    
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    

        $this->password = $row['password'];

        }

}