<?php
    class database{
        private $hostname = 'localhost';
        private $username = 'root';
        private $password = '';
        private $dbname = 'ems';
        private $conn;
        
        public function getConnection()
        {
            $this->conn = null;
            $data_name = "mysql:host=" . $this->hostname . ";dbname=" . $this->dbname; 
            try{
                $this->conn = new PDO($data_name, $this->username, $this->password);
                // $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                // echo "Connection Successful";
            }catch (PDOException $e) {
                echo "Connection Failed:" . $e->getMessage();
            }
            return $this->conn;
        }
    }
?>