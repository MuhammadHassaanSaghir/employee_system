<?php 
  //  Header Files
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  // Including Files
  include_once 'db.php';
  include_once 'read_All.php';

  //  Seting Database Connection
  $database = new db();
  $db = $database->getConnection();

  // Employees Listing
  $read = new readAll($db);
  $result = $read->employeeListing();
  if(count($result) > 0){
    // Conveting In JSON Format
    echo json_encode($result);
  }else{
    // Conveting In JSON Format
    echo json_encode(
      array('message' => 'No Employees Found','Status Code' => '400')
    );
  }
?>
