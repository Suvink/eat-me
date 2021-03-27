<?php
header("Content-Type:application/json");
header("Access-Control-Allow-Methods: GET");

require_once "./core/DBConnection.php";

$DBConnection = new DBConnection();
$con = $DBConnection->getConnection();

//Function to push into Associative arrays
function array_push_assoc($array, $key, $value)
{
    $array[$key] = $value;
    return $array;
}

if ($_SERVER['REQUEST_METHOD'] == "GET") {

    //Decode and extract phone no
    $order_id = $_GET['order_id'];

    //Get the basic order details
    $sql = "SELECT * FROM `order_details` WHERE orderId = " . $order_id;
    $result = $con->query($sql);

    if ($result !== NULL) {
        $rows = array();
        while ($r = $result->fetch_assoc()) {
            $rows[] = $r;
        }

        header("HTTP/1.1 200 OK");
        http_response_code(200);
        echo stripslashes(json_encode($rows));
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
