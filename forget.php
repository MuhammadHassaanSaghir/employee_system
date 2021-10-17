<?php

//headers for format

header('Content-Type: application/json');

header('Access-Control-Allow-Origin: *');

header('Access-Control-Allow-Methods: POST');

//include connection file

include_once "config.php";

//global variables

$message;

//$response = array();

//creat class
class forget
{
    //properties
    private $pass;
    private $confirmpassword;
    private $email;
    private $sql;
    private $conn;
    private $result;
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "forgotpass";
    private $query;
    private $queryresult;
    private $row;

    //methods
    public function chkPass()
    {

        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        //conditional statements
        if (isset($_POST['email']))
        {
            $this->email = $_POST['email'];
            $this->pass = $_POST['password'];
            $this->confirmpassword = $_POST['c-password'];
            $this->query = "SELECT * FROM employee WHERE email= '$this->email'";

            $this->queryresult = mysqli_query($this->conn, $this->query);
            $this->row = mysqli_num_rows($this->queryresult);
            //email validaation
            if ($this->row == 0)
            {
                $GLOBALS['message'] = "enter the valid mail";
            }
            //password validation
            if (!empty($this->pass))
            {
                if ($this->pass != $this->confirmpassword)
                {
                    $GLOBALS['message'] = "Please enter the same passwords";
                }
                elseif ($this->row == 1)
                {

                    $this->sql = "UPDATE employee SET password='$this->pass' WHERE email='$this->email'";
                    $this->result = mysqli_query($this->conn, $this->sql);
                    $GLOBALS['message'] = 'password succcesfully changed';

                }
            }
            //if all conditions becomes false
            else
            {
                $GLOBALS['error'] = '001';
                $GLOBALS['message'] = 'Please Enter Password !';
            }

        }

        return $this->conn;
    }
}

//creating an object
$obj = new forget();

//call a method
$obj->chkPass();

//convert into the json format
echo json_encode($message)
?>
