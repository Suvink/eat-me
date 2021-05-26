<?php
header("Content-Type:application/json");
header("Access-Control-Allow-Methods: POST");

require_once "./core/DBConnection.php";

$DBConnection = new DBConnection();
$con = $DBConnection->getConnection();


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $rawdata = file_get_contents('php://input');
    $data = json_decode($rawdata);

    //Generate OTP and Token
    $token = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 1, 10);
    $OTP = substr(str_shuffle('0123456789'), 1, 6);
    $time = time();

    //Check if the user is registered in the database
    $sql = "SELECT * FROM customer WHERE contactNo=" . $data->phone;
    $result = $con->query($sql);

    //Add a PROVISIONED profile if the user is not registered in the system
    if (!(!empty($result) && $result->num_rows > 0)) {
        //Provisioned Profile Details
        $user_name = "user-" . $token;
        $user_email = "user-" . $token . "@eat-me.live";

        $sql2 = "INSERT INTO customer(contactNo, firstName, lastName, email, profileType) VALUES ('$data->phone', '$user_name', '$user_name','$user_email', 'PROVISIONED')";
        $result2 = $con->query($sql2);
    }

    // //SendSMS
    $smsText = "Your OTP for Eat ME is " . $OTP;
    $user = "94771645198";
    $password = "1234";
    $text = urlencode($smsText);

    $to = $data->phone;
    $baseurl = "http://www.textit.biz/sendmsg";
    $url = "$baseurl/?id=$user&pw=$password&to=$to&text=$text";
    $ret = file($url);

    $res = explode(":", $ret[0]);

    if (trim($res[0]) == "OK") {
        //Add token to database
        $sql3 = "INSERT INTO otp_temp(token, otp, phone, timeStamp) VALUES ('$token', '$OTP', '$data->phone', $time)";
        $result = $con->query($sql3);
        if ($result) {
            header("HTTP/1.1 200 OK");
            http_response_code(200);
            $smsString = '{"token": "' . $token . '"}';
            $message = json_decode($smsString);
            echo stripslashes(json_encode($message));
            return;
        } else {
            header("HTTP/1.1 400 Bad Request");
            http_response_code(400);
            $message = json_decode('{"message": "Error Communicating with server. Please try again in a few minutes."}');
            echo stripslashes(json_encode($message));
            return;
        }
    } else {
        header("HTTP/1.1 400 Bad Request");
        http_response_code(400);
        $message = '{"message": "Failed to send OTP"}';
        echo stripslashes(json_encode($message));
        return;
    }
}
