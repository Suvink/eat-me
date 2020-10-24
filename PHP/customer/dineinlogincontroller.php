<?php
require_once "./config/dbconnection.php";

$isError=false;
if (isset($_POST['submit'])) {
  $token =  $_REQUEST['token'];
  $otp =  $_REQUEST['otp'];
  
  $sql = "SELECT * FROM otp_temp WHERE otp='$otp'";
  $result = $con->query($sql);
  //echo $result->num_rows;
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      if ($token === $row["token"]) {
        $sql = "DELETE FROM otp_temp WHERE otp='$otp'";
        $result = $con->query($sql);
        $_SESSION['user_phone'] = $row["phone"];
        header('Location: /dinein');
      } else {
        $isError=true;
      }
    }
  } else {
    $isError=true;
  }
}

$showError = otpError($isError) ;
function otpError($isError){
  if ($isError == true) {
    return '<div class="row artemis-notification notification-danger bounceIn"><p>Error: Invalid OTP!</p></div>';
  }
};
