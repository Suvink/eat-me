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
    $customer_phone = $_GET['phone'];

    //Get the basic order details
    $sql = "SELECT * FROM `order_details` WHERE customerId = (SELECT customerId FROM `customer` WHERE `contactNo`='" . $customer_phone . "')";
    $result = $con->query($sql);

    //Final array to be exported
    $final_array = array();

    if ($result->num_rows > 0) {
        $counter = 0;
        while ($row = $result->fetch_assoc()) {
            $order_array = array();
            if ($row['orderType'] == "online") {

                $sql2 = "SELECT * FROM `online_order` WHERE orderId =" . $row['orderId'];
                $result2 = $con->query($sql2);

                //Convert result set to PHP Array
                $item_set = array();
                while ($item = $result2->fetch_assoc()) {
                    $item_set[] = $item;
                }

                //construct Associative Array
                $order_array = array_push_assoc($order_array, 'orderID', $row['orderId']);
                $order_array = array_push_assoc($order_array, 'orderType', $row['orderType']);
                $order_array = array_push_assoc($order_array, 'totalAmount', $row['amount']);
                $order_array = array_push_assoc($order_array, 'paymentType', $row['paymentType']);
                $order_array = array_push_assoc($order_array, 'deliveryFee', $item_set[0]['delivery_fee']);
                $order_array = array_push_assoc($order_array, 'tableNo', NULL);
                $order_array = array_push_assoc($order_array, 'timestamp', $row['timestamp']);
                $order_array = array_push_assoc($order_array, 'orderStatus', $row['orderStatus']);
                $order_array = array_push_assoc($order_array, 'address', $item_set[0]['address']);
                $order_array = array_push_assoc($order_array, 'delivery', NULL);
            } else if ($row['orderType'] == "dinein") {
                $sql3 = "SELECT * FROM `dine_in_order` WHERE orderId =" . $row['orderId'];
                $result3 = $con->query($sql3);

                //Convert result set to PHP Array
                $item_set2 = array();
                while ($item = $result3->fetch_assoc()) {
                    $item_set2[] = $item;
                }

                //construct Associative Array
                $order_array = array_push_assoc($order_array, 'orderID', $row['orderId']);
                $order_array = array_push_assoc($order_array, 'orderType', $row['orderType']);
                $order_array = array_push_assoc($order_array, 'totalAmount', $row['amount']);
                $order_array = array_push_assoc($order_array, 'paymentType', $row['paymentType']);
                $order_array = array_push_assoc($order_array, 'deliveryFee', NULL);
                $order_array = array_push_assoc($order_array, 'tableNo', $item_set2[0]['tableNo']);
                $order_array = array_push_assoc($order_array, 'timestamp', $row['timestamp']);
                $order_array = array_push_assoc($order_array, 'orderStatus', $row['orderStatus']);
                $order_array = array_push_assoc($order_array, 'address', NULL);
                $order_array = array_push_assoc($order_array, 'delivery', NULL);
            }

            //Finally get the order items
            $sql4 = "SELECT * FROM `order_includes_menu` WHERE orderId =" . $row['orderId'];
            $result4 = $con->query($sql4);

            //Convert result set to PHP Array
            $item_set3 = array();
            while ($item = $result4->fetch_assoc()) {
                $item_set3[] = $item;
            }

            //print_r($order_array);

            //Assign the menu items to the main array
            $order_array = array_push_assoc($order_array, 'items', $item_set3);
            $final_array = array_push_assoc($final_array, $counter, $order_array);
            $counter++;
        }
        header("HTTP/1.1 200 OK");
        http_response_code(200);
        echo stripslashes(json_encode($final_array));
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
