<?php
  //  Main Class for Showing All Employees 
  class readAll{
      public function __construct($db){
        $this->conn = $db;
      }

      //  SQL Query Showing All Results
      public function employeeListing(){
          $select = "SELECT * FROM employee";
          $run_select = $this->conn->prepare($select);
          $run_select->execute();
          $fetch_data = $run_select->fetchAll(PDO::FETCH_ASSOC);
        //   $fetch_data += array("Status Code"=>"200");
          return $fetch_data;
      }
  }
?>