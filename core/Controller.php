<?php

//require_once "../config/OneSignalConfig.php";

class Controller
{

  function __construct()
  {
  }

  public function triggerError($message)
  {
    echo '<script src="../../plugins/ArtemisAlert/ArtemisAlert.js"></script>';
    echo "<script> artemisAlert.alert('error', '{$message}') </script>";
  }

  public function logout()
  {
    session_destroy();
    unset($_SESSION['user_phone']);
    header("Location: /online", TRUE, 302);
  }

  public function logoutstaffMem()
  { 
    session_destroy();
    unset($_SESSION['staffId']);
    header("Location: /staff/login");
  }

  public function parseParams($params)
  {
    $extractedParams = explode("&", $params);
    $paramsArray = array();
    foreach ($extractedParams as $param) {
      $splitParam = explode("=", $param);
      $paramsArray[$splitParam[0]] = $splitParam[1];
    }
    return $paramsArray;
  }

  function sendPushNotification($messageString)
  {
    $content = array(
      "en" => $messageString
    );
    $headings = array(
      "en" => 'New Order Received!'
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
}
