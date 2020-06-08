<?php
class Services{
    private $conn;
    private $table = 'services';
    public $id;
    public $description;
    
    public function __construct($db){
        $this->conn = $db;
    }
    
    
    public function read(){
        $query = 'SELECT
                p.id,
                p.description
                FROM
                ' . $this->table . ' p';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
    
        return $stmt;
    }
        public function read_single(){
        $query = 'SELECT
            p.id,
            p.description
        FROM
        ' . $this->table . ' p
        WHERE
            p.id = ?
        LIMIT 0,1';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1,$this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->description = $row['description'];
        
    }
}
