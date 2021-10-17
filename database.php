<?php
include_once 'connnection.php';

class Database extends connection{

	private $table_name= "users";
	public $id, $name, $email, $pass;
	public $response = array();
	public $status = array(
        200 => '200 OK',
        400 => '400 Bad Request',
        422 => 'Unprocessable Entity',
        500 => '500 Internal Server Error'
        );

	//validation and required 
	public function test_inputs($data){
		if(empty($data))
		{
			return null;
		}
		else {
		 	$data= strip_tags($data);
		 	$data= htmlspecialchars($data);
		 	$data= stripslashes($data);
		 	$data= trim($data);
		 	return $data;
	 	}
 	}

 	//FILTER EMAIL ADDRESS
 	function test_email($email){
		// Removes all illegal characters from email
		$email = filter_var($email, FILTER_SANITIZE_EMAIL);
		// Validate e-mail
		if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
			return $email;
		} 
 	}

 	// signup function
	public function signup (){

			$sql = 'INSERT INTO users (name,email,pass) VALUES (:name,:email,:pass)';
			$stmt = $this->conn->prepare($sql);
			$stmt->bindValue(':name', $this->name);
			$stmt->bindValue(':email', $this->email);
			$stmt->bindValue(':pass', $this->pass);
			
			if($stmt->execute()){
				$this->id = $this->conn->lastInsertId();
				return true;
			}
			else {
				return false;
			}
	}

	//if user already exits function
	public function useralreadyexists(){
		$query = "SELECT COUNT(email) AS num FROM users WHERE email= :email";

		$insert = $this->conn->prepare($query);
		$insert->bindValue(':email', $this->email);
		$insert->execute();

		$row = $insert->fetch(PDO:: FETCH_ASSOC);
		if($row['num'] > 0){
			return true;
		}
		else {
			return false;
		}
	}

	//JSON Format
   public function displayresponse($response){
   	return json_encode($response);
   }

}

?>