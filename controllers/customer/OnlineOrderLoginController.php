<?php
require_once './core/Controller.php';
session_set_cookie_params('3600');
session_start();
ob_start();

class OnlineOrderLoginController extends Controller
{

  public function __construct()
  {
    require './models/customer/OnlineOrderLoginModel.php';
    $this->OnlineOrderLoginModel = new OnlineOrderLoginModel();
  }

  function submitLogin($token, $otp)
  {
    $result = $this->OnlineOrderLoginModel->getAllDataWhere('otp_temp', 'otp', $otp);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        if ($token === $row["token"]) {
          $deleteQuery = $this->OnlineOrderLoginModel->deleteData('otp_temp', 'token', $token);
          echo $row["phone"];
          $_SESSION['user_phone'] = $row["phone"];
          echo '<script>alert("wade hari")</script>';
          header('Location: /online');
        } else {
          $this->triggerError('Login Failed!');
        }
      }
    } else {
      $this->triggerError('Login Failed!');
    }
  }
}
