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

  public function getOrderTotal(){
    $calculatedTotal = 0;
    foreach($this->orderArray as $item_price => $item_qty) {
      $result =  $this->OnlineOrderSummeryModel->getAllDataWhere("menu", "itemNo", $item_price);
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          $calculatedTotal = $calculatedTotal + ($row['price'] * $item_qty) ;
        }
      }else{
        $calculatedTotal = $calculatedTotal;
      }
    }
    //First check if the order total mathes with the DB. Then Convert to 2 decimal places and return
    if($calculatedTotal == $this->orderTotal){
      echo '<h3 class="mt-1 mb-1">'.number_format((float)$calculatedTotal, 2, '.', '').'</h3>';
    }
    //TODO: redirect with an error if that doesnt match
  }

  public function renderFinalOrder(){
    foreach($this->orderArray as $item_price => $item_qty) {
      $result =  $this->OnlineOrderSummeryModel->getAllDataWhere("menu", "itemNo", $item_price);
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          $item_total_price = $item_qty * $row['price'];
          echo  '<div class="menu-selected-item">
                  <div class="menu-selected-row">
                    <div class="menu-selected-row-delete"><i class="check-icon fas fa-check-circle"></i></div>
                    <div class="menu-selected-row-image">
                      <img src="'.$row['url'].'">
                    </div>
                    <div class="menu-selected-row-description has-text-left">
                      <h4 class="mb-0 mt-0">'.$row['itemName'].'</h4>
                      <h5 class="mb-0 mt-0">Qty: '.$item_qty.'</h5>
                    </div>
                    <div class="menu-selected-row-price">
                      <h4 class="mb-0 mt-0 has-text-right">'.number_format((float)$item_total_price, 2, '.', '').'</h4>
                    </div>
                  </div>
                </div>';
        }
      }
    }
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
