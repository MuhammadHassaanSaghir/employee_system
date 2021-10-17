<?php
include_once "conn.php";
include_once "user.php";
$database = new Database();
$db = $database->getConnection();

$user = new User($db);


$user->email = $_POST['email'];
$user->password = $_POST['password'];

//create user 
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

print_r(json_encode($user_array));

?>