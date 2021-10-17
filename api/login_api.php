<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Content-Type: application/json');

include_once '../config/database.php';
include_once "../login.php";


$database = new database();
$db = $database->getConnection();
$user = new login($db);


$user->email = $_POST['email'];
$user->pass = $_POST['pass'];

//create user 
if($_SERVER['REQUEST_METHOD'] =='POST'){
	if($user->login()){

		$user_array = array(
			"status"=> true,
			"message"=> "Successful login!",
			
		);
	}
	else{
		$user_array= array(
			"status"=> false,
			"message"=>"login again"
		);
	}
}

print_r(json_encode($user_array));

?>