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
    public function getSingleClient(){
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
    WHERE
        id = ?';

    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1,$this->id);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $this->created_at = $row['created_at'];
    $this->updated_at = $row['updated_at'];
    $this->first_name = $row['first_name'];
    $this->last_name = $row['last_name'];
    $this->email = $row['email'];
    $this->phone_number = $row['phone_number'];
    $this->password = $row['password'];
    $this->street = $row['street'];
    $this->suburb = $row['suburb'];
    $this->city = $row['city'];
    $this->postcode = $row['postcode'];
    }

}
