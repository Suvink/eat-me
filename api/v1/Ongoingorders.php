<?php
header("Content-Type:application/json");
header("Access-Control-Allow-Methods: GET");

require_once "./core/DBConnection.php";

$DBConnection = new DBConnection();
$con = $DBConnection->getConnection();


if ($_SERVER['REQUEST_METHOD'] == "GET") {

  //Add the review into the table
//   $sql = "SELECT * FROM 'order_details'";
//   $result = $con->query($sql);

//   header("HTTP/1.1 200 OK");
//   http_response_code(200);
//   $messageString = '{"message": "Table Reserved"}';
//   $message = json_decode($messageString);
//   echo stripslashes(json_encode($message));
  echo 'Test 01';

//   if ($result === TRUE) {
    
//     return;
//   } else {
//     header("HTTP/1.1 400 Bad Request");
//     http_response_code(400);
//     $message = '{"message": "Reservation Failed"}';
//     echo stripslashes(json_encode($message));
//     return;
//   }
}
