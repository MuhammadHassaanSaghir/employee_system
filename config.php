<?php

//class

class Database{

  //properties

  private $servername = "localhost";
  private $username = "root";
  private $password = "";
  private $dbname = "forgotpass";
  public $conn;

// methods

  public function connection()
  {
    $this->conn = null;

    //chk connection 

    try {
      $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
       echo "Connected Successfull!";
    }
    catch(connect_error $e) {
  die("Connection failed: " . $e->geterror());
}
return $this->conn;
    }

}

?>