<?php

require_once './core/Controller.php';

class OnlineOrderSummeryController extends Controller
{

  private $orderArray;
  private $orderTotal;
  private $deliveryFee;
  private $itemCounter;

  function __construct()
  {
    require './models/customer/OnlineOrderSummeryModel.php';
    $this->OnlineOrderSummeryModel = new OnlineOrderSummeryModel();
  }

  public function setOrderArray($orderData)
  {
    $this->orderArray = json_decode($orderData);
  }
  public function setorderTotal($totalValue)
  {
    $this->orderTotal = $totalValue;
  }

  public function getOrderID()
  {
    $result = $this->OnlineOrderSummeryModel->executeSql('SELECT * FROM `order_details` ORDER BY `orderId` DESC LIMIT 1');
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo $row['orderId'] + 1;
      }
    }else{
      echo 5000;
    }
  }

  public function getOrderItems()
  {
    print_r($this->orderArray);
  }

  public function getDeliveryFee()
  {
    $result = $this->OnlineOrderSummeryModel->getAllDataWhere("delivery_fees", "type", 'standard');
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $this->deliveryFee = number_format((float)$row['price'], 2, '.', '');
        echo number_format((float)$row['price'], 2, '.', '');
      }
    }
  }

  public function getTotalOrderFee()
  {
    if ($this->deliveryFee && $this->orderTotal) {
      //cant keep the order total in double because we are double checking the user's order against DB for any hacks 
      echo number_format((float)($this->deliveryFee + $this->orderTotal), 2, '.', '');
    }
  }

  public function getOrderTotal()
  {
    $calculatedTotal = 0;
    foreach ($this->orderArray as $item_price => $item_qty) {
      $result =  $this->OnlineOrderSummeryModel->getAllDataWhere("menu", "itemNo", $item_price);
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          $calculatedTotal = $calculatedTotal + ($row['price'] * $item_qty);
        }
      } else {
        $calculatedTotal = $calculatedTotal;
      }
    }
    //First check if the order total mathes with the DB. Then Convert to 2 decimal places and return
    if ($calculatedTotal == $this->orderTotal) {
      echo number_format((float)$calculatedTotal, 2, '.', '');
    }
    //TODO: redirect with an error if that doesnt match
  }

  public function renderFinalOrder()
  {
    $counter = 1;
    foreach ($this->orderArray as $item_price => $item_qty) {
      $result =  $this->OnlineOrderSummeryModel->getAllDataWhere("menu", "itemNo", $item_price);
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          $item_total_price = $item_qty * $row['price'];
          echo  '<div class="menu-selected-item">
                  <div class="menu-selected-row">
                    <div class="menu-selected-row-delete"><i class="check-icon fas fa-check-circle"></i></div>
                    <div class="menu-selected-row-image">
                      <img src="../' . $row['url'] . '">
                    </div>
                    <div class="menu-selected-row-description has-text-left">
                      <h4 class="mb-0 mt-0">' . $row['itemName'] . '</h4>
                      <h5 class="mb-0 mt-0">Qty: ' . $item_qty . '</h5>
                    </div>
                    <div class="menu-selected-row-price">
                      <h4 class="mb-0 mt-0 has-text-right">' . number_format((float)$item_total_price, 2, '.', '') . '</h4>
                    </div>
                  </div>
                  <input name="item_name_' . $counter . '" value="' . $row['itemName'] . '" style="display:none;">
                  <input name="amount_' . $counter . '" value="' . number_format((float)$item_total_price, 2, '.', '') . '" style="display:none;">
                  <input name="quantity_' . $counter . '" value="' . $item_qty . '" style="display:none;">
                  <input name="item_code_' . $counter . '" value="' . $item_price . '" style="display:none;">
                </div>';
          $counter++;
        }
      }
    }
    $this->itemCounter = $counter;
  }

  public function getItemCount(){
    //Minus 1 to account for the last increment
    echo $this->itemCounter - 1;
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

  public function getUserFname($phone)
  {
    $result = $this->OnlineOrderSummeryModel->getAllDataWhere('customer', 'contactNo', $phone);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo $row['firstName'];
      }
    }
  }

  public function getUserLname($phone)
  {
    $result = $this->OnlineOrderSummeryModel->getAllDataWhere('customer', 'contactNo', $phone);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo $row['lastName'];
      }
    }
  }

}
