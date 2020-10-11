<?php
header("Content-Type:application/json");
header("Access-Control-Allow-Methods: POST");

require_once "./config/dbconnection.php";

if($_SERVER['REQUEST_METHOD']=="POST"){
    $rawdata = file_get_contents('php://input');
    $data = json_decode($rawdata);
    
    //Check if the user is registered in the database
    $sql = "SELECT * FROM users WHERE phone=".$data->phone;
    $result = $con-> query($sql);
    
    if(!empty($result) && $result-> num_rows > 0){

        //Generate OTP and Token
        $token = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,10);
        $OTP = substr(str_shuffle('0123456789'),1,6);
        $time = time();

        // // //SendSMS
        $smsText = "Your OTP for Eat ME is ".$OTP;
        $user = "94771655198";
        $password = "1357";
        $text = urlencode($smsText);

        $to = $data->phone;
        $baseurl ="http://www.textit.biz/sendmsg";
        $url = "$baseurl/?id=$user&pw=$password&to=$to&text=$text";
        $ret = file($url);

        $res= explode(":",$ret[0]);

        if (trim($res[0])=="OK")
        {
            //Add token to database
            $sql2 = "INSERT INTO tokens(token, otp, time) VALUES ('$token', '$OTP', $time)";
            $result = $con-> query($sql2);
            if ($result) {
                header("HTTP/1.1 200 OK");
                http_response_code(200);
                $smsString = '{"token": "'.$token.'"}';
                $message = json_decode($smsString);
                echo stripslashes(json_encode($message));
                return;
            }else{
                header("HTTP/1.1 400 Bad Request");
                http_response_code(400);
                $message = json_decode('{"message": "Error Communicating with server. Please try again in a few minutes."}');
                echo stripslashes(json_encode($message));
                return;
            }
        }
        else
        {
            header("HTTP/1.1 400 Bad Request");
            http_response_code(400);
            $message = '{"message": "Failed to send OTP"}';
            echo stripslashes(json_encode($message));
            return;
        }

    }else{
        header("HTTP/1.1 400 Bad Request");
        http_response_code(400);
        $message = json_decode('{"message": "User Not Found"}');
        echo stripslashes(json_encode($message));
        return;
    }
    
}




?>