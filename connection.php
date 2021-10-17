<?php

class connection{ 
   private $servername = "localhost:3307";
   private  $username = "root";
   private  $password = "";
   private  $dbName="test";
   public $conn;

   //get connection
   public function __construct(){
    try {
    	$this->conn = new PDO("mysql:host=" .$this->servername. ";dbname=" .$this->dbName, $this->username, $this->password);
      $this->conn->exec("set names utf8");
      //echo "Connected";      
    } catch(PDOException $e) {
    	echo "Connection failed: " . $e->getMessage();
    }
   return $this->conn; 
 }

   

}

?>