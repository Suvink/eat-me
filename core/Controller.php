<?php

class Controller
{

  function __construct()
  {
  }

  public function triggerError($message)
  {
    echo '<script src="../../plugins/ArtemisAlert/ArtemisAlert.js"></script>';
    echo "artemisAlert.alert('error', '{$message}')";
  }

  public function logout(){
    session_destroy();
    unset($_SESSION['user_phone']);
    header("Location: /online",TRUE,302);
  }

  public function logoutstaffMem(){
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

  
}
