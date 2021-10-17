<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Content-Type: application/json');

include_once 'database.php';
include_once 'connnection.php';


	$user = new Database();

	if($_SERVER['REQUEST_METHOD'] =='POST'){

		$user->name = $user->test_inputs($_POST['name']);
		$user->pass = base64_encode($user->test_inputs($_POST['pass']));

		//filters email 
		$user->email = $user->test_email($_POST['email']);

		if($user->name == null or $user->pass==null or $user->email==null){
			$response= array(
				"status"=> false,
				"message"=>"All fields are required!"
			);

		}
		else if($user->useralreadyexists()){
			$response= array(
				"status"=> false,
				"message"=>"Email id already exists!"
			);
		}
		else if($user->signup()){
			$response = array(
				"status"=> true,
				"message"=> "Successful Sign Up!",
				"id"=> $user->id,
				"name"=>$user->name,
				"email"=>$user->email
			);
		}
		else{
			$response= array(
				"status"=> false,
				"message"=>"Unsuccessful Sign up!"
			);
		}
		echo $user->displayresponse($response)  ;
	}

?>