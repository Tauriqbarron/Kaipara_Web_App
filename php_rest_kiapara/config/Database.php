<?php
    class Database{

        private $host = 'fnx6frzmhxw45qcb.cbetxkdyhwsb.us-east-1.rds.amazonaws.com';
        private $db_name ='zipqe0vxecoaypmr';
        private $username ='pq0p5h2u5c2ipxlp';
        private $password = 'h5ngnc9raovh1yz1';
        private $conn; 

        public function connect(){
            $this->conn = null;

            try{
                $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, 
                $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }catch(PDOException $e){
                echo 'Connection Error: ' . $e->getMessage();        
            }

            return $this->conn;
        }
    }