<?php

class Applications{
    private $conn;
    private $table = 'staff';
    public  $id;
    public $fname;
    public $lname;
    public $password;


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