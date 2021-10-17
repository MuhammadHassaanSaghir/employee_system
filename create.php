<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once 'Database.php';
  include_once 'Employee.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate emp object
  $emp = new Employee($db);

  // Get raw Employeeed data
  $data = json_decode(file_get_contents("php://input"));

  $emp->full_name = $data->full_name;
  $emp->designation = $data->designation;
  $emp->email = $data->email;
  // Create Employee
  if($emp->Add_Employee()) {
    echo json_encode(array('full_name' => $data->full_name , 'designation' => $data->designation , 'email' => $data->email , 'message' => 'Employee Created Sucessfully','Status Code ' => '200'));
  } else {
    echo json_encode(array('message' => 'Failed to Create Employee','Status Code' => '400'));
  }
