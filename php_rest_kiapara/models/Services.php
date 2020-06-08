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
}
