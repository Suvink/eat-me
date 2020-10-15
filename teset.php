<?php

require_once "./config/dbconnection.php";

$sql = "INSERT INTO otp_temp(token, otp, phone, timeStamp) VALUES ('OGASJNRBLK', '716528', '0771655198', 1602739523)";
$result = $con->query($sql);
echo $result;
?>