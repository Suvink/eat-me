<?php

session_start();
ob_start();

if (!isset($_SERVER['HTTP_REFERER'])) {
  //header('Location: /online/login');
}
if (!isset($_SESSION['user_phone'])) {
  header('Location: /online/login');
}

require_once './controllers/customer/OnlineOrderSummeryController.php';
//Initiate an instance of controller
$OnlineOrderSummeryController = new OnlineOrderSummeryController();

//Process the incoming order data
if (isset($_POST['orderdetails'])) {
  $orderData = $_REQUEST['orderArray'];
  $orderTotal = $_REQUEST['totalValue'];

  $OnlineOrderSummeryController->setOrderArray($orderData);
  $OnlineOrderSummeryController->setorderTotal($orderTotal);
}

if (isset($_POST['logout'])) {
  $OnlineOrderSummeryController->logout();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" type="image/png" href="../../img/favicon.png" />
  <!-- Global Styles -->
  <link rel="stylesheet" href="../../css/style.css" />
  <!-- Local Styles -->
  <link rel="stylesheet" href="../../css/onlineorderSummeryStyles.css">
  <title>Online Order Summery</title>
</head>

<body>

  <div class="navbar">
    <div class="columns group">
      <div class="column is-2">
        <img src="../../img/logo.png" height=56 width="224" />
      </div>
      <div class="column is-10 has-text-right nav-logout">
        <i class="fa fa-user" aria-hidden="true"></i>
        <?php
        $OnlineOrderSummeryController->renderNavBar($_SESSION['user_phone']);
        ?>
        <form class="d-inline" action="/online" method="POST">
          <button class="button is-primary" name="logout">Logout</button>
        </form>
      </div>
    </div>
  </div>

  <section>
    <form action="/online/profile" method="POST">
      <div class="columns group">
        <div class="column is-3"></div>
        <div class="column is-6">
          <div class="card">
            <h1 class="orange-color mt-0 mb-1">Order Summery</h1>
            <div class="menu-items">
              <div class="menu-selected-item">
                <div class="menu-selected-row">
                  <div class="menu-selected-row-delete"><i class="check-icon fas fa-check-circle"></i></div>
                  <div class="menu-selected-row-image">
                    <img src="https://image.flaticon.com/icons/svg/184/184406.svg">
                  </div>
                  <div class="menu-selected-row-description has-text-left">
                    <h4 class="mb-0 mt-0">Chicken Burger</h4>
                    <h5 class="mb-0 mt-0">Qty: 1</h5>
                  </div>
                  <div class="menu-selected-row-price">
                    <h4 class="mb-0 mt-0 has-text-right">350.00</h4>
                  </div>
                </div>
              </div>
              <div class="menu-selected-item">
                <div class="menu-selected-row">
                  <div class="menu-selected-row-delete"><i class="check-icon fas fa-check-circle"></i></div>
                  <div class="menu-selected-row-image">
                    <img src="https://image.flaticon.com/icons/svg/1775/1775636.svg">
                  </div>
                  <div class="menu-selected-row-description has-text-left">
                    <h4 class="mb-0 mt-0">Chinese Ramen</h4>
                    <h5 class="mb-0 mt-0">Qty: 1</h5>
                  </div>
                  <div class="menu-selected-row-price">
                    <h4 class="mb-0 mt-0 has-text-right">350.00</h4>
                  </div>
                </div>
              </div>
            </div>
            <div class="total-box d-flex">
              <div class="title-col">
                <h3 class="mt-1 mb-1">Order Total</h3>
              </div>
              <div class="price-col mr-1">
                <h3 class="mt-1 mb-1">700.00</h3>
              </div>
            </div>
            <div class="delivery-info">
              <h3 class="has-text-left">Delivery Information</h3>
              <label class="field artemis-input-field">
                <input class="artemis-input" type="text" placeholder="Your email here" required>
                <span class="label-wrap">
                  <span class="label-text">Email to send the receipt</span>
                </span>
              </label>
              <label class="field artemis-input-field">
                <input class="artemis-input" type="text" placeholder="Your delivery address here" required>
                <span class="label-wrap">
                  <span class="label-text">Address</span>
                </span>
              </label>
              <label class="field artemis-input-field">
                <select class="artemis-input artemis-select" type="text" required>
                  <option value="saab">Colombo</option>
                  <option value="mercedes">Gampaha</option>
                  <option value="audi">Veyangoda</option>
                </select>
                <span class="label-wrap">
                  <span class="label-text">Your city</span>
                </span>
              </label>
              <label class="field artemis-input-field">
                <input class="artemis-input" type="text" placeholder="Add landmarks here">
                <span class="label-wrap">
                  <span class="label-text">Landmarks</span>
                </span>
              </label>
              <label class="field artemis-input-field">
                <input class="artemis-input" type="text" placeholder="Any special requests?">
                <span class="label-wrap">
                  <span class="label-text">Remarks</span>
                </span>
              </label>
            </div>
            <div class="total-amount">
              <div class="total-box d-flex nobottom">
                <div class="title-col">
                  <h3 class="mt-1 mb-0">Order Total:</h3>
                </div>
                <div class="price-col mr-1">
                  <h3 class="mt-1 mb-0 has-text-right">700.00</h3>
                </div>
              </div>
              <div class="total-box d-flex nobottom">
                <div class="title-col">
                  <h3 class="mt-0 mb-1">Delivery Fee:</h3>
                </div>
                <div class="price-col mr-1">
                  <h3 class="mt-0 mb-1 has-text-right">100.00</h3>
                </div>
              </div>
              <div class="total-box d-flex">
                <div class="title-col">
                  <h3 class="mt-0 mb-1">Total Amount:</h3>
                </div>
                <div class="price-col mr-1">
                  <h3 class="mt-0 mb-1 has-text-right">800.00</h3>
                </div>
              </div>
            </div>
            <div class="mt-1 payment-buttons">
              <button class="payment-button" type="submit" name="place-order"><img class="payment-option" src="../../img/payhere.png" alt=""></button>
              <button class="payment-button" type="submit" name="place-order"><img class="payment-option" src="../../img/paycash.png" alt=""></button>
            </div>
          </div>
        </div>
        <div class="column is-3"></div>
      </div>
    </form>
  </section>


</body>