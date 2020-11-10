<?php
require_once './core/Controller.php';
session_start();
ob_start();

class StaffLoginController extends Controller
{

  public function __construct()
  {
    require './models/store/StaffLoginModel.php';
    $this->StaffLoginModel = new StaffLoginModel();
  }

  function submitLogin($username, $password)
  {
    $result = $this->StaffLoginModel->getAllDataWhere('staff', "staffId", $username);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        if ($password === $row["password"]) {
            $_SESSION['staffId']=$row['staffId'];
         
         
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
