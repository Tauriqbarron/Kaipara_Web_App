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
    
    public function create(){
        $query = 'INSERT INTO '. $this->table .'
            SET
                first_name = :first_name,
                last_name = :last_name,
                email = :email,
                phone_number = :phone_number,
                password = :password,
                street = :street,
                suburb = :suburb,
                city = :city,
                postcode = :postcode';

        $stmt = $this->conn->prepare($query);

        $this->first_name = htmlspecialchars(strip_tags($this->first_name));
        $this->last_name = htmlspecialchars(strip_tags($this->last_name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->phone_number = htmlspecialchars(strip_tags($this->phone_number));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->street = htmlspecialchars(strip_tags($this->street));
        $this->suburb = htmlspecialchars(strip_tags($this->suburb));
        $this->city = htmlspecialchars(strip_tags($this->city));
        $this->postcode = htmlspecialchars(strip_tags($this->postcode));

        $stmt->bindParam(':first_name', $this->first_name);
        $stmt->bindParam(':last_name', $this->last_name);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':phone_number', $this->phone_number);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':street', $this->street);
        $stmt->bindParam(':suburb', $this->suburb);
        $stmt->bindParam(':city', $this->city);
        $stmt->bindParam(':postcode', $this->postcode);

        if($stmt->execute()){
            return  true;
        }

        printf("Error: %s. \n", $stmt->error);

        return false;

    }
    
    public function update(){
        $query = 'UPDATE '. $this->table .'
            SET
                first_name = :first_name,
                last_name = :last_name,
                email = :email,
                phone_number = :phone_number,
                password = :password,
                street = :street,
                suburb = :suburb,
                city = :city,
                postcode = :postcode
            WHERE
                id= :id';

        $stmt = $this->conn->prepare($query);

        $this->first_name = htmlspecialchars(strip_tags($this->first_name));
        $this->last_name = htmlspecialchars(strip_tags($this->last_name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->phone_number = htmlspecialchars(strip_tags($this->phone_number));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->street = htmlspecialchars(strip_tags($this->street));
        $this->suburb = htmlspecialchars(strip_tags($this->suburb));
        $this->city = htmlspecialchars(strip_tags($this->city));
        $this->postcode = htmlspecialchars(strip_tags($this->postcode));
        $this->id = htmlspecialchars(strip_tags($this->id));


        $stmt->bindParam(':first_name', $this->first_name);
        $stmt->bindParam(':last_name', $this->last_name);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':phone_number', $this->phone_number);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':street', $this->street);
        $stmt->bindParam(':suburb', $this->suburb);
        $stmt->bindParam(':city', $this->city);
        $stmt->bindParam(':postcode', $this->postcode);
        $stmt->bindParam(':id', $this->id);

        if($stmt->execute()){
            return  true;
        }

        printf("Error: %s. \n", $stmt->error);

        return false;

    }
        public function delete(){
        $query = 'DELETE FROM ' . $this->table . ' WHERE id= :id';
        $stmt = $this->conn->prepare($query);
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(':id', $this->id);

        if($stmt->execute()){
            return  true;
        }

        printf("Error: %s. \n", $stmt->error);

        return false;
    }
        public function login(){
        $query = 'SELECT 
            password
        FROM
            '. $this->table .'
        WHERE
        email= ?';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1,$this->email);
        $stmt->execute();
        $stmt->bind_result($password);
        $stmt->fetch()
        $this->password = $password;
    }
}
