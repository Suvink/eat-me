<?php

require_once './core/Controller.php';

class OnlineOrderSummeryController extends Controller{

  private $orderArray;
  private $orderTotal;

  function __construct()
  {
    require './models/customer/OnlineOrderSummeryModel.php';
    $this->OnlineOrderSummeryModel = new OnlineOrderSummeryModel();
    
  }

  public function setOrderArray($orderData){
    $this->orderArray = json_decode($orderData);
  }
  public function setorderTotal($totalValue){
      $this->orderTotal = $totalValue;
  }

  public function renderNavBar($phone)
  {
    $result = $this->OnlineOrderSummeryModel->getAllDataWhere('customer', 'contactNo', $phone);
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