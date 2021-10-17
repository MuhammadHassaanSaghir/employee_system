<?php
    class user{
        private $conn;
        private $table_name="admin";
        public $email;
        public $password;
        public function __construct($db) {
        $this->conn = $db;
        }
        function login(){
        
        $query = "SELECT * FROM ".$this->table_name." WHERE email='".$this->email."'AND password='".$this->password."'";
           
           $stmt=$this->conn->prepare($query);
           $stmt->execute();
        //    return $stmt;
           $row = $stmt->fetch(PDO:: FETCH_ASSOC);

            if($stmt->rowcount()> 0){
            return $stmt;
            }
            else {
            return false;
            }
        }
    }
    ?>