<?php

require_once './core/Controller.php';

class OnlineOrderController extends Controller
{

  function __construct()
  {
    require './models/customer/OnlineOrderModel.php';
    $this->OnlineOrderModel = new OnlineOrderModel();
  }

  public function renderNavBar($phone)
  {
    $result = $this->OnlineOrderModel->getAllDataWhere('customer', 'contactNo', $phone);
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

  public function renderMainMenu(){
    $sql = "SELECT * FROM menu WHERE type='mains' AND availability='TRUE'";
    $result = $this->OnlineOrderModel->executeSql($sql);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo '
        <div class="menu-card" id="menu-'.$row['itemNo'].'" onclick="addToCart('.$row['itemNo'].')">
          <div class="menu-card-content">
            <img id="item-picture-'.$row['itemNo'].'" src="'.$row['url'].'">
            <h3 id="name-'.$row['itemNo'].'" class="mt-1 mb-0">'.$row['itemName'].'</h3>
            <h5 id="price-'.$row['itemNo'].'" class="mt-0">LKR '.$row['price'].'</h5>
          </div>
        </div>
        ';
      }
    }
  }

  public function renderSidesMenu(){
    $sql = "SELECT * FROM menu WHERE type='starters' AND availability='TRUE'";
    $result = $this->OnlineOrderModel->executeSql($sql);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo '
        <div class="menu-card" id="menu-'.$row['itemNo'].'" onclick="addToCart('.$row['itemNo'].')">
          <div class="menu-card-content">
            <img id="item-picture-'.$row['itemNo'].'" src="'.$row['url'].'">
            <h3 id="name-'.$row['itemNo'].'" class="mt-1 mb-0">'.$row['itemName'].'</h3>
            <h5 id="price-'.$row['itemNo'].'" class="mt-0">LKR '.$row['price'].'</h5>
          </div>
        </div>
        ';
      }
    }
  }

  public function renderBeveragesMenu(){
    $sql = "SELECT * FROM menu WHERE type='beverages' AND availability='TRUE'";
    $result = $this->OnlineOrderModel->executeSql($sql);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo '
        <div class="menu-card" id="menu-'.$row['itemNo'].'" onclick="addToCart('.$row['itemNo'].')">
          <div class="menu-card-content">
            <img id="item-picture-'.$row['itemNo'].'" src="'.$row['url'].'">
            <h3 id="name-'.$row['itemNo'].'" class="mt-1 mb-0">'.$row['itemName'].'</h3>
            <h5 id="price-'.$row['itemNo'].'" class="mt-0">LKR '.$row['price'].'</h5>
          </div>
        </div>
        ';
      }
    }
  }

  public function renderDessertMenu(){
    $sql = "SELECT * FROM menu WHERE type='desserts' AND availability='TRUE'";
    $result = $this->OnlineOrderModel->executeSql($sql);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo '
        <div class="menu-card" id="menu-'.$row['itemNo'].'" onclick="addToCart('.$row['itemNo'].')">
          <div class="menu-card-content">
            <img id="item-picture-'.$row['itemNo'].'" src="'.$row['url'].'">
            <h3 id="name-'.$row['itemNo'].'" class="mt-1 mb-0">'.$row['itemName'].'</h3>
            <h5 id="price-'.$row['itemNo'].'" class="mt-0">LKR '.$row['price'].'</h5>
          </div>
        </div>
        ';
      }
    }
  }

  public function getCustomerID($phone)
  {
    $result = $this->OnlineOrderModel->getAllDataWhere('customer', 'contactNo', $phone);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        return $row['customerId'];
      }
    }
  }

  public function hasExistingOrder($phone){
    $customer_id = $this->getCustomerID($phone);
    $result = $this->OnlineOrderModel->executeSql('SELECT * FROM `order_details` WHERE `customerId`='.$customer_id.' AND `orderStatus`!=8');
    if ($result->num_rows > 0) {
      return TRUE;
    }else{
      return FALSE;
    }
  }



}
