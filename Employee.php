<?php
// Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once 'Database.php';
  include_once 'Employee.php';

  class Employee {
    // DB stuff
    private $conn;
    private $table = 'employee';

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    //Data Secure
    public function Data_Security($data) {
          $data = trim($data);
          $data = stripslashes($data);
          $data = htmlspecialchars($data);
          $data = strip_tags($data);
          return $data;
        }


     // Create Employee
    public function Add_Employee() {
        $stmt = $this->conn->prepare('INSERT INTO ' . $this->table . ' SET full_name = :full_name, designation = :designation, email = :email');

          //Validation of data while storing it in database
          if (empty($this->full_name)) {
              echo  "Name is required<br>";
            } 
            else if($err_name = !preg_match("/^[a-zA-Z ]*$/", $this->full_name)){
              echo "Only Letters and Space Allowed in Name<br>";
            }
            else {
              //Data_Security & Bind data
              $this->full_name = Data_Security($this->full_name);
              $stmt->bindParam(':full_name', $this->full_name);
            }

            if (empty($this->designation)) {
              echo  "<br>Designation is required";
            } 
            else {
              //Data_Security & Bind data
              $this->designation = Data_Security($this->designation);
              $stmt->bindParam(':designation', $this->designation);
            }

            if (empty($this->email)) {
              echo  "<br>Email is required<br>";
            } 
            else if ($err_invalid_email = !filter_var($this->email, FILTER_VALIDATE_EMAIL))
            {
              echo "Email is Invalid <br>";
            }
            else {
              $this->email = filter_var($this->email, FILTER_SANITIZE_EMAIL);
              // Bind data
              $stmt->bindParam(':email', $this->email);
            }
          
          // Execute query
          if($this->full_name != '' && $this->designation != '' && $this->email != '' && $err_invalid_email == false && $err_name == false ) {
            $stmt->execute();
            return true;
          }
          
      return false;
    }

  }
