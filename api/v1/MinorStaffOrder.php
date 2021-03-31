<?php
header("Content-Type:application/json");
header("Access-Control-Allow-Methods: GET");

require_once "./core/DBConnection.php";

$DBConnection = new DBConnection();
$con = $DBConnection->getConnection();

if ($_SERVER['REQUEST_METHOD'] == "GET") {

    //get staff id
    $staff_id = $_GET['staff_id'];

    //Get order details of assigned order of steward
    $sql = "SELECT staff_order.orderId,customer.customerId, customer.firstName, customer.lastName, order_details.amount,order_details.orderStatus,dine_in_order.tableNo FROM `staff_order` JOIN order_details ON staff_order.orderId=order_details.orderId JOIN customer ON order_details.customerId=customer.customerId JOIN dine_in_order ON dine_in_order.orderId=order_details.orderId WHERE (staff_order.staffId=$staff_id AND order_details.orderStatus<9)";
    //Get order details of assigned order of DP
    $sql2 = "SELECT staff_order.orderId,customer.customerId, customer.firstName, customer.lastName, order_details.amount,order_details.orderStatus,online_order.address,online_order.delivery_fee FROM `staff_order` JOIN order_details ON staff_order.orderId=order_details.orderId JOIN customer ON order_details.customerId=customer.customerId JOIN online_order ON online_order.orderId=order_details.orderId WHERE (staff_order.staffId=$staff_id AND order_details.orderStatus<9)";

    $result = $con->query($sql);
    $result2 = $con->query($sql2);

    if ($result->num_rows > 0) {

        $rows = array();
        while ($r = $result->fetch_assoc()) {
            $rows[] = $r;
        }

        header("HTTP/1.1 200 OK");
        http_response_code(200);
        echo stripslashes(json_encode($rows));
        return;
    }else if ($result2->num_rows > 0) {
        $rows2 = array();
        while ($r2 = $result2->fetch_assoc()) {
            $rows2[] = $r2;
        }

        header("HTTP/1.1 200 OK");
        http_response_code(200);
        echo stripslashes(json_encode($rows2));
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
