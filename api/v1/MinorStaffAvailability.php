<?php
header("Content-Type:application/json");
header("Access-Control-Allow-Methods: GET");

require_once "./core/DBConnection.php";

$DBConnection = new DBConnection();
$con = $DBConnection->getConnection();

if ($_SERVER['REQUEST_METHOD'] == "GET") {

	//get staff id
	$staff_id=$_GET['staff_id'];

  //Get details of relevent staff member
  $sql = "SELECT status FROM `minor_staff` WHERE staffId='$staff_id'";
  $result = $con->query($sql);

  if ($result !== NULL) {
   
    //Convert result set to JSON
    $r = $result->fetch_assoc();
  
    header("HTTP/1.1 200 OK");
    http_response_code(200);
    echo stripslashes(json_encode($r));
    return;
    
  } else {
    header("HTTP/1.1 400 Bad Request");
    http_response_code(400);
    $message = '{"message": "Could not fetch orders"}';
    echo stripslashes(json_encode($message));
    return;
  }

}else if ($_SERVER['REQUEST_METHOD'] == "POST"){
    
    $rawdata = file_get_contents('php://input');
    $receivedData = json_decode($rawdata);

    print_r($receivedData);

    //Update availability to the database
    $sql = "UPDATE `minor_staff` SET `status`='".$receivedData->state."' WHERE `staffId`=".$receivedData->staffId."";
		$result = $con->query($sql);
		
		if ($result == true) {

			header("HTTP/1.1 200 OK");
			http_response_code(200);
			echo stripslashes(json_encode($result));
			return;
		} else {
			header("HTTP/1.1 400 Bad Request");
			http_response_code(400);
			$message = '{"message": "Could not fetch orders"}';
			echo stripslashes(json_encode($message));
			return;
		}	

}else{
    header("HTTP/1.1 405 Method Not Allowed");
    http_response_code(405);
    $message = '{"message": "Method Not Allowed"}';
    echo stripslashes(json_encode($message));
    return;
}
