<?php

require_once './core/Controller.php';

class DineinController extends Controller
{

  function __construct()
  {
    require './models/customer/DineinModel.php';
    $this->DineinModel = new DineinModel();
  }

  public function renderNavBar($phone)
  {
    $result = $this->DineinModel->getAllDataWhere('customer', 'contactNo', $phone);
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
    $result = $this->DineinModel->getAllDataWhere('menu', 'type', 'mains');
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
    $result = $this->DineinModel->getAllDataWhere('menu', 'type', 'starters');
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
    $result = $this->DineinModel->getAllDataWhere('menu', 'type', 'beverages');
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
    $result = $this->DineinModel->getAllDataWhere('menu', 'type', 'desserts');
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
    $result = $this->DineinModel->getAllDataWhere('customer', 'contactNo', $phone);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        return $row['customerId'];
      }
    }
  }

  public function getOrderIdByCustomerId($phone){
    $customer_id = $this->getCustomerID($phone);
    $result = $this->DineinModel->executeSql('SELECT * FROM `order_details` WHERE `customerId`='.$customer_id.' AND `orderStatus`!=8 AND `orderType`="dinein"');
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo $row['orderId'];
        return $row['orderId'];
      }
    }
  }

  public function hasExistingOrder($phone){
    $customer_id = $this->getCustomerID($phone);
    $result = $this->DineinModel->executeSql('SELECT * FROM `order_details` WHERE `customerId`='.$customer_id.' AND `orderStatus`!=8 AND `orderType`="dinein"');
    if ($result->num_rows > 0) {
      return TRUE;
    }else{
      return FALSE;
    }
  }



}
