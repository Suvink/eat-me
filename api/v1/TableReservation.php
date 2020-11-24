<?php
header("Content-Type:application/json");
header("Access-Control-Allow-Methods: GET");

require_once "./core/DBConnection.php";

$DBConnection = new DBConnection();
$con = $DBConnection->getConnection();


if ($_SERVER['REQUEST_METHOD'] == "GET") {
  
  //Add the review into the table
  $sql = "INSERT INTO `customer_rates_order`(`orderRating`, `description`, `orderId`) VALUES (" . $data->rating . ",'" . $data->review . "'," . $data->id . ")";
  $result = $con->query($sql);


  if ($result === TRUE) {
    header("HTTP/1.1 200 OK");
    http_response_code(200);
    $messageString = '{"message": "Review Added"}';
    $message = json_decode($messageString);
    echo stripslashes(json_encode($message));
    return;
  } else {
    header("HTTP/1.1 400 Bad Request");
    http_response_code(400);
    $message = '{"message": "Failed to add review"}';
    echo stripslashes(json_encode($message));
    return;
  }
}
