<?php
header("Content-Type:application/json");
header("Access-Control-Allow-Methods: POST");

//require_once "../../config/OneSignalConfig.php";

function sendPushNotification($messageString, $headingString)
{
    $content = array(
        "en" => $messageString
    );
    $headings = array(
        "en" => $headingString
    );
    $fields = array(
        'app_id' => "950f0adf-2de5-4613-a7b0-8790f3104caa",
        'included_segments' => array(
            'Subscribed Users'
        ),
        'contents' => $content,
        'headings' => $headings
    );

    $fields = json_encode($fields);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json; charset=utf-8',
        'Authorization: Basic OTBkODcyYWQtMGMzNy00ZmU2LWE2NjItNTJkNzlmOTA3ZTll'
    ));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

    $response = curl_exec($ch);
    curl_close($ch);

    return $response;
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $rawdata = file_get_contents('php://input');
    $data = json_decode($rawdata);
    //print_r($data);

    //Send the notification
    $res = sendPushNotification($data->message, $data->header );

    header("HTTP/1.1 200 OK");
    http_response_code(200);
    $message = json_decode($res);
    echo stripslashes(json_encode($message));
    return;
} else {
    header("HTTP/1.1 405 Method Not Allowed");
    http_response_code(405);
    $message = '{"message": "Method Not Allowed"}';
    echo stripslashes(json_encode($message));
    return;
}
