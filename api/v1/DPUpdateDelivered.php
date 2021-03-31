<?php
header("Content-Type:application/json");
header("Access-Control-Allow-Methods: GET");

require_once "./core/DBConnection.php";

$DBConnection = new DBConnection();
$con = $DBConnection->getConnection();

if ($_SERVER['REQUEST_METHOD'] == "GET") {

    //get staff id
    $order_id = $_GET['order_id'];

    //update order status
    $sql = "UPDATE `order_details` SET `orderStatus`=7 WHERE `orderId`=$order_id";

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
} else {
    header("HTTP/1.1 405 Method Not Allowed");
    http_response_code(405);
    $message = '{"message": "Method Not Allowed"}';
    echo stripslashes(json_encode($message));
    return;
}
