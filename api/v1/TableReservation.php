<?php
header("Content-Type:application/json");
header("Access-Control-Allow-Methods: POST");

require_once "./core/DBConnection.php";

$DBConnection = new DBConnection();
$con = $DBConnection->getConnection();


if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $rawdata = file_get_contents('php://input');
  $data = json_decode($rawdata);
  
  $status=$data->isReserved ? "'Reserved'" : "'Not Reserved'" ;

  //Add the review into the table
  $sql = "UPDATE `table_details` SET `reservation`=". $status."WHERE `tableNo`=".$data->table;
  
  $result = $con->query($sql);


  if ($result === TRUE) {
    header("HTTP/1.1 200 OK");
    http_response_code(200);
    $messageString = '{"message": "Table Reserved"}';
    $message = json_decode($messageString);
    echo stripslashes(json_encode($message));
    return;
  } else {
    header("HTTP/1.1 400 Bad Request");
    http_response_code(400);
    $message = '{"message": "Reservation Failed"}';
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
