<?php

require_once './core/Controller.php';

class OnlineOrderController extends Controller
{

  function __construct()
  {
    require './models/customer/OnlineOrderModel.php';
    $this->OnlineOrderModel = new OnlineOrderModel();
  }

  public function logout(){
    session_destroy();
    unset($_SESSION['user_phone']);
    header("Location: /online",TRUE,302);
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
    $result = $this->OnlineOrderModel->getAllDataWhere('menu', 'type', 'mains');
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo '
        <div class="menu-card" id="menu-'.$row['itemNo'].'" onclick="addToCart('.$row['itemNo'].')">
          <div class="menu-card-content">
            <img id="item-picture-'.$row['itemNo'].'" src="https://image.flaticon.com/icons/svg/1775/1775636.svg">
            <h3 id="name-'.$row['itemNo'].'" class="mt-1 mb-0">'.$row['itemName'].'</h3>
            <h5 id="price-'.$row['itemNo'].'" class="mt-0">LKR '.$row['price'].'</h5>
          </div>
        </div>
        ';
      }
    }
  }

  public function renderSidesMenu(){
    $result = $this->OnlineOrderModel->getAllDataWhere('menu', 'type', 'starters');
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo '
        <div class="menu-card" id="menu-'.$row['itemNo'].'" onclick="addToCart('.$row['itemNo'].')">
          <div class="menu-card-content">
            <img id="item-picture-'.$row['itemNo'].'" src="https://www.flaticon.com/svg/static/icons/svg/1046/1046786.svg">
            <h3 id="name-'.$row['itemNo'].'" class="mt-1 mb-0">'.$row['itemName'].'</h3>
            <h5 id="price-'.$row['itemNo'].'" class="mt-0">LKR '.$row['price'].'</h5>
          </div>
        </div>
        ';
      }
    }
  }

  public function renderBeveragesMenu(){
    $result = $this->OnlineOrderModel->getAllDataWhere('menu', 'type', 'beverages');
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo '
        <div class="menu-card" id="menu-'.$row['itemNo'].'" onclick="addToCart('.$row['itemNo'].')">
          <div class="menu-card-content">
            <img id="item-picture-'.$row['itemNo'].'" src="https://www.flaticon.com/svg/static/icons/svg/1046/1046781.svg">
            <h3 id="name-'.$row['itemNo'].'" class="mt-1 mb-0">'.$row['itemName'].'</h3>
            <h5 id="price-'.$row['itemNo'].'" class="mt-0">LKR '.$row['price'].'</h5>
          </div>
        </div>
        ';
      }
    }
  }

  public function renderDessertMenu(){
    $result = $this->OnlineOrderModel->getAllDataWhere('menu', 'type', 'desserts');
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo '
        <div class="menu-card" id="menu-'.$row['itemNo'].'" onclick="addToCart('.$row['itemNo'].')">
          <div class="menu-card-content">
            <img id="item-picture-'.$row['itemNo'].'" src="https://www.flaticon.com/svg/static/icons/svg/1046/1046767.svg">
            <h3 id="name-'.$row['itemNo'].'" class="mt-1 mb-0">'.$row['itemName'].'</h3>
            <h5 id="price-'.$row['itemNo'].'" class="mt-0">LKR '.$row['price'].'</h5>
          </div>
        </div>
        ';
      }
    }
  }



}
