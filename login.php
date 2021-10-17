<?php

    class login{
        private $conn;
        private $table_name="users";
        public $email;
        public $pass;
        
        public function __construct($db) {
            $this->conn = $db;
        }
        function login(){
        
        $query = "SELECT * FROM ".$this->table_name." WHERE email='".$this->email."'AND pass='".$this->pass."'";
           
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