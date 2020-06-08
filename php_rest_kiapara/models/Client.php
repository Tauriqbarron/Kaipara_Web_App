<?php 
class Client{
    private $conn;
    private $table = 'clients';
    public $id;
    public $created_at;
    public $updated_at;
    public $first_name;
    public $last_name;
    public $email;
    public $phone_number;
    public $password;
    public $street;
    public $suburb;
    public $city;
    public $postcode;

    public function __construct($db){
        $this->conn = $db;
    }

    public function getClient(){
        $query = 'SELECT 
            id,
            created_at,
            updated_at,
            first_name,
            last_name,
            email,
            phone_number,
            password,
            street,
            suburb,
            city,
            postcode
        FROM
            ' . $this->table .'
    ';

    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt;
    }

}