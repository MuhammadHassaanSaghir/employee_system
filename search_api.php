<?php 
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    include_once 'db.php';
    include_once 'search.php';
    $database = new db();
    $db = $database->getConnection();

    // Get Value from User in JSON Format
    $key_data = json_decode(file_get_contents("php://input"), true);
    $input_data = $key_data['value'];

    $searched = new search($db);
    $result = $searched->find($input_data);
    if(count($result)){
        echo json_encode($result);
    }else{
        echo json_encode(
        array('message' => 'No Employees Found','Status Code' => '400')
        );
    }
?>
