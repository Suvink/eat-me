<?php

require_once './core/Controller.php';

class OnlineCustomerProfileController extends Controller{

  function __construct()
  {
    require './models/customer/OnlineCustomerProfileModel.php';
    $this->OnlineCustomerProfileModel = new OnlineCustomerProfileModel();
    
  }


  public function renderNavBar($phone)
  {
    $result = $this->OnlineCustomerProfileModel->getAllDataWhere('customer', 'contactNo', $phone);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        //Trim to first name of provisioned users because the system generated usernames are too long
        if ($row['profileType'] == 'PROVISIONED') {
          echo '<span class="mr-1">' . $row['firstName'] . '</span>';
        } else {
          echo '<span class="mr-1">' . $row['firstName'] . ' ' . $row['lastName'] . '</span>';
        }
      }
    }
  }

  

}

?>
