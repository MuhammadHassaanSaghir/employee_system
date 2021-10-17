<?php 
  class Database {
    // DB Params
    private $host = 'localhost';
    private $db_name = 'pf';
    private $username = 'root';
    private $password = '';
    public $conn;

    // DB Connect
    public function getconnection() {
      $this->conn = null;

      try { 
        $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch(PDOException $e) {
        echo 'Connection Error: ' . $e->getMessage();
      }

      return $this->conn;
    }
  }
  ?>