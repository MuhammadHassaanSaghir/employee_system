<?php

//headers for format

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');

//include connection file

include_once '../config/database.php';

//creat class
class forget
{
    //properties
    private $pass;
    private $confirmpassword;
    private $email;
    private $sql;
    private $result;
    private $query;
    private $queryresult;
    private $row;
    private $table_name ="users";
    public $response;

    public function __construct($db) {
          $this->conn = $db;
    }

    //methods
    public function chkPass()
    {
        //conditional statements
        if($_SERVER['REQUEST_METHOD'] =='POST')
        {
            $this->email = $_POST['email'];
            $this->pass = $_POST['pass'];
            $this->confirmpassword = $_POST['cpass'];

            $this->query = "SELECT * FROM ".$this->table_name." WHERE email='".$this->email."'";

            $stmt = $this->conn->prepare($this->query);
            $stmt->execute();

            $row = $stmt->fetch(PDO:: FETCH_ASSOC);
            //email validation
            if ($stmt->rowcount() < 0)
            {
                $response= array(
                "status"=> false,
                "message"=>"Enter the valid mail!"
                );
            }
            //password validation
            else if (!empty($this->pass))
            {
                if ($this->pass != $this->confirmpassword)
                {
                     $response= array(
                     "status"=> false,
                     "message"=>"Please enter the same passwords"
                );

                }
                elseif ($stmt->rowcount() == 1)
                {
                    $this->sql = "UPDATE users SET pass='$this->pass' WHERE email='$this->email'";
                    $stmt = $this->conn->prepare($this->sql);
                    $stmt->execute();
                    $response= array(
                     "status"=> true,
                     "message"=>"Password succcesfully changed!"
                );
                }
            }
            //if all conditions becomes false
            else
            {
                $response= array(
                     "status"=> false,
                     "message"=>"Please Enter Password !"
                );
            }
            print_r(json_encode($response));
        }

    }
}

//creating an object

$database = new database();
$db = $database->getConnection();

$obj = new forget($db);

//call a method
$obj->chkPass();

//convert into the json format
?>
