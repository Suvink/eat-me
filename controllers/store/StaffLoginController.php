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

  function submitLogin($userid, $password)
  {
  
    $result = $this->StaffLoginModel->getAllDataWhere('staff', "staffId", $userid);
    // echo MD5("gunasiri@123");
    // echo MD5($password);

    if ($result->num_rows > 0) 
    {
      while ($row = $result->fetch_assoc()) 
      {
        if( MD5($password) === $row["password"])
        {
          if ($row['tag']=="ACTIVE") 
          {
              $_SESSION['staffId']=$row['staffId'];
              $_SESSION['firstName']=$row['firstName'];
              $_SESSION['lastName']=$row['lastName'];
              $_SESSION['roleId']=$row['roleId'];
              
              // $_SESSION['lastName']=$row['staffId'];

            switch ($row["roleId"]) 
            {
              case 1: 
                $_SESSION['lastUpdated']="------";
                header('Location: /admin');
              break;
              case 2:
                $_SESSION['popup-1'] = "style=display:none";
                $_SESSION['popup-rider'] = "style=display:none";
                $_SESSION['popup-summery'] = "style=display:none"; 
                header('Location: /kitchendisplay/orders');
              break;
              case 3: 
                header('Location: /steward');
              break;
              case 4: 
                header('Location: /cashier');
              break;
              case 5: 
                header('Location: /deliveryperson');
              break;
              default:
                http_response_code(404);
                header('Location: /error');
                break;
              
            }
          
          } 
          else 
          {
            echo '<script language="javascript">';
            echo 'alert("Account Deactivated")';
            echo '</script>';
          }
        }
        else
        {
          $this->triggerError('Login Failed!');
        }
      }
    } 
    else 
    {
      $this->triggerError('Login Failed!');
    }
  }
}
