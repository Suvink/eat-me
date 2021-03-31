<?php
header("Content-Type:application/json");
header("Access-Control-Allow-Methods: POST");

require_once "./core/DBConnection.php";

$DBConnection = new DBConnection();
$con = $DBConnection->getConnection();


if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $inputData = file_get_contents('php://input');
  $data = json_decode($inputData);

  //Add the review into the table
  $sql = "INSERT INTO `minor_rates_customer`(`customerRating`, `orderId`, `customerId`) VALUES (" . $data->rateNum . "," . $data->orderId . "," . $data->cusId . ")";
  $sql2=  "UPDATE `order_details` SET `orderStatus`='8' WHERE `orderId`=$data->orderId";
  $sql3="UPDATE `table_details` SET `reservation`='NotReserved' WHERE tableNo IN (SELECT table_details.tableNo FROM `table_details` JOIN dine_in_order ON dine_in_order.tableNo=table_details.tableNo WHERE dine_in_order.orderId=".$data->orderId.")";
  
  $result = $con->query($sql);
  $result2=$con->query($sql2);
  $result3=$con->query($sql3);
  
  if ($result === TRUE && $result2 === TRUE && $result2 === TRUE) {
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
    echo stripslashes(json_encode($data));
    return;
  }
}
