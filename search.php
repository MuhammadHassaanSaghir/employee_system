<?php
    class search{
        public function __construct($db) {
        $this->conn = $db;
        }

        public function find($value){
            // CONCAT => SQL String Function is to join multiple columns data in one column But here join column to search required input
            $query = "SELECT * FROM employee_tbl WHERE CONCAT(full_name, ' ',email, ' ',phone, ' ',designation, ' ') LIKE :value";
            $run = $this->conn->prepare($query);
            // Short Way to Bind Value
            $run->execute(array("value"=>"%".$value."%"));
            $searched_data = $run->fetchAll(PDO::FETCH_ASSOC);
            $searched_data += array("Status Code"=>"200");
            return $searched_data;
        }
    }
?>