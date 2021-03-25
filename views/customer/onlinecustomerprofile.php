<?php

session_start();
ob_start();

if (!isset($_SESSION['user_phone'])) {
  header('Location: /online/login');
}

require_once './controllers/customer/OnlineCustomerProfileController.php';
//Initiate an instance of controller
$OnlineCustomerProfileController = new OnlineCustomerProfileController();

//Catch Profile Edits
if (isset($_POST['update-profile'])) {
  $OnlineCustomerProfileController->setProfileData($_REQUEST['first_name'], $_REQUEST['last_name'], $_REQUEST['user_email'], $_SESSION['user_phone']);
}

//catch cash payments
if (isset($_POST['place-order'])) {
  
  //Insert the Order into DB
  $customer_id = $OnlineCustomerProfileController->getCustomerID($_SESSION['user_phone']);
  $OnlineCustomerProfileController->setOrderDetails($_REQUEST['order_id'], $customer_id, $_REQUEST['amount'], 'cash', $_REQUEST['delivery_fee']);

  //Log the order
  $OnlineCustomerProfileController->setOnlineOrder($_REQUEST['order_id'], $_REQUEST['address']);

  //Insert order items into the table
  for($i=1; $i<=$_REQUEST['item_count']; $i++){
    $item_string = "item_code_".$i;
    $qty_string = "quantity_".$i;
    $OnlineCustomerProfileController->setOrderItems($_REQUEST[$item_string], $_REQUEST[$qty_string], $_REQUEST['order_id']);
  }
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
  <link rel="stylesheet" href="../../css/onlinecustomerprofilestyles.css">
  <link rel="stylesheet" href="../../plugins/ArtemisAlert/ArtemisAlert.css">
  <title>Customer Profile</title>
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
        $OnlineCustomerProfileController->renderNavBar($_SESSION['user_phone']);
        ?>
        <form class="d-inline" action="/online" method="POST">
          <button class="button is-primary" name="logout">Logout</button>
        </form>
      </div>
    </div>
  </div>

  <section>
    <div class="row"><a class="back-btn" href="/online">
        <p class="ml-1 mt-0 mb-0"><i class="fas fa-arrow-left mr-1"></i>Back to Menu</p>
      </a></div>
  </section>
  <section>
    <div class="has-text-centered">
      <h2 class="title">My Profile</h2>
      <div class="columns group">
        <div class="column is-2"></div>
        <div class="column is-4">
          <img class="profile-avatar" src="../../img/dp.jpg" alt="">
        </div>
        <div class="column is-4">
          <form action="/online/profile" method="POST">
            <label class="field artemis-input-field">
              <input name="first_name" class="artemis-input" value="<?php $OnlineCustomerProfileController->getFName($_SESSION['user_phone']) ?>" type="text" placeholder="Your first name here">
              <span class="label-wrap">
                <span class="label-text">First Name</span>
              </span>
            </label>
            <label class="field artemis-input-field">
              <input name="last_name" class="artemis-input" value="<?php $OnlineCustomerProfileController->getLName($_SESSION['user_phone']) ?>" type="text" placeholder="Your last name here">
              <span class="label-wrap">
                <span class="label-text">Last Name</span>
              </span>
            </label>
            <label class="field artemis-input-field">
              <input name="user_email" class="artemis-input" value="<?php $OnlineCustomerProfileController->getEmail($_SESSION['user_phone']) ?>" type="email" placeholder="Your email here">
              <span class="label-wrap">
                <span class="label-text">Email Address</span>
              </span>
            </label>
            <div class="row has-text-left">
              <button class="button is-primary" name="update-profile" type="submit">Change</button>
            </div>
          </form>
        </div>
        <div class="column is-2"></div>
      </div>
    </div>
  </section>

  <section class="mt-2">
    <div class="has-text-centered">
      <h2 class="title">My Orders</h2>
    </div>
    <div class="content">
      <div class="order-card">
        <div class="columns group">
          <div class="column is-6">
            <img class="delivery-image" src="../../img/deliveryguy.gif" alt="">
          </div>
          <div class="column is-6 info-column">
            <h4 class="title orange-color">Order #3212</h4>
            <div class="order-value d-flex">
              <h6 class="subtitle mt-0 mb-0">Amount: </h6>
              <h6 class="title mt-0 mb-0">700.00</h6>
            </div>
            <div class="order-time d-flex mt-1">
              <h6 class="subtitle mt-0 mb-0">Date: </h6>
              <h6 class="title mt-0 mb-0">12/11/2020</h6>
            </div>
            <button class="button is-warning mt-1" name="logout"><i class="check-icon fas fa-check-circle"></i>Confirmed</button>
          </div>
        </div>
        <hr>
        <h5 class=" ml-0 mb-0 title">Order Items</h5>
        <p class="menu-items">Chicken Ramen x1, Dosai x20, Faluda x2</p>
        <div class="columns group">
          <div class="column is-6 has-text-left">
            <h5 class=" ml-0 mb-0 title">Payment</h5>
            <img class="payment-option" src="../../img/payhere.png" alt="">
          </div>
          <div class="column is-6 has-text-right">
            <h6 class=" ml-0 mb-0 title">Lakshan is on his way!</h6>
            <h6 class=" ml-0 mb-0 mt-0 title">+94771655198</h6>
          </div>
        </div>
      </div>

      <div class="order-card">
        <div class="columns group">
          <div class="column is-6">
            <img class="delivery-image" src="../../img/done.png" alt="">
          </div>
          <div class="column is-6 info-column">
            <h4 class="title orange-color">Order #3212</h4>
            <div class="order-value d-flex">
              <h6 class="subtitle mt-0 mb-0">Amount: </h6>
              <h6 class="title mt-0 mb-0">700.00</h6>
            </div>
            <div class="order-time d-flex mt-1">
              <h6 class="subtitle mt-0 mb-0">Date: </h6>
              <h6 class="title mt-0 mb-0">12/11/2020</h6>
            </div>
            <button class="button is-success mt-1" name="logout"><i class="check-icon fas fa-check-circle"></i>Completed</button>
          </div>
        </div>
        <hr>
        <h5 class=" ml-0 mb-0 title">Order Items</h5>
        <p class="menu-items">Chicken Ramen x1, Dosai x20, Faluda x2</p>
        <div class="columns group">
          <div class="column is-6 has-text-left">
            <h5 class=" ml-0 mb-0 title">Payment</h5>
            <img class="payment-option" src="../../img/paycash.png" alt="">
          </div>
          <div class="column is-6 has-text-right"></div>
        </div>
      </div>
      <div class="order-card">
        <div class="columns group">
          <div class="column is-6">
            <img class="delivery-image" src="../../img/done.png" alt="">
          </div>
          <div class="column is-6 info-column">
            <h4 class="title orange-color">Order #3212</h4>
            <div class="order-value d-flex">
              <h6 class="subtitle mt-0 mb-0">Amount: </h6>
              <h6 class="title mt-0 mb-0">700.00</h6>
            </div>
            <div class="order-time d-flex mt-1">
              <h6 class="subtitle mt-0 mb-0">Date: </h6>
              <h6 class="title mt-0 mb-0">12/11/2020</h6>
            </div>
            <button class="button is-success mt-1" name="logout"><i class="check-icon fas fa-check-circle"></i>Completed</button>
          </div>
        </div>
        <hr>
        <h5 class=" ml-0 mb-0 title">Order Items</h5>
        <p class="menu-items">Chicken Ramen x1, Dosai x20, Faluda x2</p>
        <div class="columns group">
          <div class="column is-6 has-text-left">
            <h5 class=" ml-0 mb-0 title">Payment</h5>
            <img class="payment-option" src="../../img/payhere.png" alt="">
          </div>
          <div class="column is-6 has-text-right"></div>
        </div>
      </div>
    </div>
  </section>
</body>

</html>