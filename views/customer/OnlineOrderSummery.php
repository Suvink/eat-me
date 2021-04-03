<?php

session_start();
ob_start();
$payment_method = "";

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
if (isset($_POST['orderdetails-payhere']) || isset($_POST['orderdetails-cash'])) {
  if (isset($_POST['orderdetails-payhere'])) {
    $payment_method = "payhere";
  } else {
    $payment_method = "cash";
  }
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
    <?php
    if ($payment_method == 'payhere') {
      echo '<form action="https://sandbox.payhere.lk/pay/checkout" method="POST">';
    } else {
      echo '<form action="/online/profile" method="POST">';
    }
    ?>
    <div class="columns group">
      <div class="column is-3"></div>
      <div class="column is-6">
        <div class="card">
          <h1 class="orange-color mt-0 mb-1">Order Summery</h1>
          <div class="menu-items">
            <?php
            $OnlineOrderSummeryController->renderFinalOrder();
            ?>
          </div>
          <div class="total-box d-flex">
            <div class="title-col">
              <h3 class="mt-1 mb-1">Order Total</h3>
            </div>
            <div class="price-col mr-1">
              <h3 class="mt-1 mb-1">
                <?php
                  $OnlineOrderSummeryController->getOrderTotal();
                ?>
              </h3>
            </div>
          </div>
          <div class="delivery-info">
            <h3 class="has-text-left">Delivery Information</h3>
            <label class="field artemis-input-field">
              <input class="artemis-input" name="email" type="text" placeholder="Your email here" required>
              <span class="label-wrap">
                <span class="label-text">Email to send the receipt</span>
              </span>
            </label>
            <label class="field artemis-input-field">
              <input name="address" class="artemis-input" type="text" placeholder="Your delivery address here" required>
              <span class="label-wrap">
                <span class="label-text">Address</span>
              </span>
            </label>
            <label class="field artemis-input-field">
              <select name="city" class="artemis-input artemis-select" type="text" required>
                <option value="Colombo">Colombo</option>
                <option value="Gampaha">Gampaha</option>
                <option value="Veyangoda">Veyangoda</option>
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
                <h3 class="mt-1 mb-0 has-text-right">
                  <?php
                  $OnlineOrderSummeryController->getOrderTotal();
                  ?>
                </h3>
              </div>
            </div>
            <div class="total-box d-flex nobottom">
              <div class="title-col">
                <h3 class="mt-0 mb-0">Delivery Fee:</h3>
              </div>
              <div class="price-col mr-1">
                <h3 class="mt-0 mb-0 has-text-right">
                  <?php
                  $OnlineOrderSummeryController->getDeliveryFee();
                  ?>
                </h3>
              </div>
            </div>
            <div class="total-box d-flex nobottom">
              <div class="title-col">
                <h3 class="mt-0 mb-1">VAT(15%):</h3>
              </div>
              <div class="price-col mr-1">
                <h3 class="mt-0 mb-1 has-text-right">
                  <?php
                  echo $OnlineOrderSummeryController->getVat();
                  ?>
                </h3>
              </div>
            </div>
            <div class="total-box d-flex">
              <div class="title-col">
                <h3 class="mt-0 mb-1">Total Amount:</h3>
              </div>
              <div class="price-col mr-1">
                <h3 class="mt-0 mb-1 has-text-right">
                  <?php
                    $OnlineOrderSummeryController->getTotalOrderFee();
                  ?>
                </h3>
              </div>
            </div>
          </div>
          <div class="payhere-config">
            <input type="hidden" name="merchant_id" value="1214666">
            <input type="hidden" name="return_url" value="http://localhost/online/summery">
            <input type="hidden" name="cancel_url" value="http://localhost/online/summery">
            <input type="hidden" name="notify_url" value="http://localhost/online/summery">
            <input type="hidden" name="country" value="Sri Lanka" style="display: none;">
            <input type="text" name="items" value="Eat Me online" style="display: none;">
            <input type="text" name="currency" value="LKR" style="display: none;">
            <input type="hidden" name="order_id" value="<?php $OnlineOrderSummeryController->getOrderID() ?>" style="display: none;">
            <input type="text" name="amount" value="<?php $OnlineOrderSummeryController->getTotalOrderFee() ?>" style="display: none;">
            <input type="text" name="first_name" value="<?php $OnlineOrderSummeryController->getUserFname($_SESSION['user_phone']) ?>" style="display: none;">
            <input type="text" name="last_name" value="<?php $OnlineOrderSummeryController->getUserLname($_SESSION['user_phone']) ?>" style="display: none;">
            <input type="text" name="phone" value="<?php echo $_SESSION['user_phone'] ?>" style="display: none;">
            <input type="text" name="item_count" value="<?php $OnlineOrderSummeryController->getItemCount() ?>" style="display: none;">
            <input type="text" name="delivery_fee" value="<?php $OnlineOrderSummeryController->getDeliveryFee() ?>" style="display: none;">
          </div>
          <div class="mt-1 payment-buttons">
            <?php
            if ($payment_method == 'payhere') {
              echo '<button class="payment-button" type="submit" name="place-order"><img class="payment-option" src="../../img/payhere.png" alt=""></button>';
            } else {
              echo '<button class="payment-button" value="ok" type="submit" name="place-order"><img class="payment-option" src="../../img/paycash.png" alt=""></button>';
            }
            ?>
          </div>
        </div>
      </div>
      <div class="column is-3"></div>
    </div>
    </form>
  </section>


</body>
