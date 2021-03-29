<?php

require_once "./core/DBConnection.php";

$DBConnection = new DBConnection();
$con = $DBConnection->getConnection();


$merchant_id         = $_POST['merchant_id'];
$order_id             = $_POST['order_id'];
$payhere_amount     = $_POST['payhere_amount'];
$payhere_currency    = $_POST['payhere_currency'];
$status_code         = $_POST['status_code'];
$md5sig                = $_POST['md5sig'];

$merchant_secret = '8RgzQCkjxgY8Qq84PCz7cj4vXOLzVKmlU8gcbHWbIPdF'; // Replace with your Merchant Secret (Can be found on your PayHere account's Settings page)

$local_md5sig = strtoupper(md5($merchant_id . $order_id . $payhere_amount . $payhere_currency . $status_code . strtoupper(md5($merchant_secret))));

if (($local_md5sig === $md5sig) and ($status_code == 2)) {
    //TODO: Update your database as payment success
    if ($status_code == 2 || $status_code == 0) {
        $sql = "UPDATE `order_details` SET `paymentType` = 'payhere', `payment_status` = 'COMPLETED' WHERE `orderId`=" . $order_id;
        $result = $con->query($sql);
    }
}
