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

     // Create Employee
    public function Add_Employee() {

        $stmt = $this->conn->prepare('INSERT INTO ' . $this->table . ' SET full_name = :full_name, designation = :designation, email = :email');

          //Validation of data while storing it in database
          if (empty($this->full_name)) {
              echo  "Name is required<br>";
            } else if($err_name = !preg_match("/^[a-zA-Z ]*$/", $this->full_name)){
              echo "Only Letters and Space Allowed in Name<br>";
            }else {
              $this->full_name = htmlspecialchars(strip_tags(trim($this->full_name)));
              // Bind data
              $stmt->bindParam(':full_name', $this->full_name);
            }

            if (empty($this->designation)) {
              echo  "<br>Designation is required";
            } else {
              $this->designation = htmlspecialchars(strip_tags(trim($this->designation)));
              // Bind data
              $stmt->bindParam(':designation', $this->designation);
            }
          if (empty($this->email)) {
              echo  "<br>Email is required<br>";
            } else if ($err_invalid_email = !filter_var($this->email, FILTER_VALIDATE_EMAIL))
            {
              echo "Email is Invalid <br>";
            }else {
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