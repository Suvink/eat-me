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
  $OnlineCustomerProfileController->setOrderDetails($_REQUEST['order_id'], $customer_id, 'online', $_REQUEST['amount'], 'cash');

  //Log the order
  $OnlineCustomerProfileController->setOnlineOrder($_REQUEST['order_id'], $_REQUEST['address'], $_REQUEST['delivery_fee']);

  //Insert order items into the table
  for ($i = 1; $i <= $_REQUEST['item_count']; $i++) {
    $item_string = "item_code_" . $i;
    $qty_string = "quantity_" . $i;
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
          <!-- Hidden user phone for order fetching -->
          <input id="user-phone" value="<?php echo $_SESSION['user_phone']; ?>" style="display:none">
        </div>
        <div class="column is-2"></div>
      </div>
    </div>
  </section>

  <section class="mt-2">
    <div class="has-text-centered">
      <h2 class="title">My Orders</h2>
    </div>
    <div class="content" id="order-card-group">
    </div>
  </section>
  <script src="../../plugins/ArtemisAlert/ArtemisAlert.js"></script>
  <script>
    function getOrderStatus(code) {
      switch (code) {
        case "1":
          return "Placed";
          break;
        case "2":
          return "Accepted";
          break;
        case "3":
          return "Steward Assigned";
          break;
        case "4":
          return "Driver Assigned";
          break;
        case "5":
          return "Ready";
          break;
        case "6":
          return "Served";
          break;
        case "7":
          return "Deliverded";
          break;
        case "8":
          return "Completed";
          break;
        default:
          return "None"
      }
    }

    function getDate(stamp) {
      let date_ob = new Date(stamp * 1000);
      let year = date_ob.getFullYear();
      let month = ("0" + (date_ob.getMonth() + 1)).slice(-2);
      let date = ("0" + date_ob.getDate()).slice(-2);

      return year + "/" + month + "/" + date;

    }

    function getButtonClass(code) {
      if (code == "8") {
        return "is-success"
      } else {
        return "is-warning"
      }
    }

    async function getOrders() {
      //clear the existing data
      document.getElementById("order-card-group").innerHTML = "";

      let userPhone = document.getElementById("user-phone").value;

      try {
        let requestURL = '/api/v1/customerorders?phone=' + userPhone;
        const response = await fetch(requestURL, {
          method: 'GET',
        });
        let responseData = JSON.parse(await response.text());
        //console.log(responseData);

        //Iterate through each object of the response array
        responseData.forEach(function(order_item) {

          let orderItems = "";
          order_item.items.forEach(function(item) {
            orderItems = orderItems + item.itemNo + " x" + item.qty + " ,";
          });

          let htmlBlock = `
          <div class="order-card">
            <div class="columns group">
              <div class="column is-6">
                <img class="delivery-image" src="`+(order_item.orderStatus == "8" ? "../../img/done.png": "../../img/deliveryguy.gif")+`" alt="">
              </div>
              <div class="column is-6 info-column">
                <h4 class="title orange-color">Order #` + order_item.orderID + `</h4>
                <div class="order-value d-flex">
                  <h6 class="subtitle mt-0 mb-0">Amount: </h6>
                  <h6 class="title mt-0 mb-0">` + order_item.totalAmount + `.00</h6>
                </div>
                <div class="order-time d-flex mt-1">
                  <h6 class="subtitle mt-0 mb-0">Date: </h6>
                  <h6 class="title mt-0 mb-0">` + getDate(order_item.timestamp) + `</h6>
                </div>
                <button class="button ` + getButtonClass(order_item.orderStatus) + ` mt-1">
                <i class="check-icon fas fa-check-circle"></i>` + getOrderStatus(order_item.orderStatus) + `</button>
              </div>
            </div>
            <hr>
            <h5 class=" ml-0 mb-0 title">Order Items</h5>
            <p class="menu-items">` + orderItems + `</p>
            <div class="columns group">
              <div class="column is-6 has-text-left">
                <h5 class=" ml-0 mb-0 title">Payment</h5>
                <img class="payment-option" src="` + (order_item.paymentType == "payhere" ? "../../img/ayhere.png" : "../../img/paycash.png") + `" alt="">
              </div>
              <div class="column is-6 has-text-right"></div>
            </div>
          </div>
        `;

          //Assign the block to the main
          document.getElementById("order-card-group").innerHTML = document.getElementById("order-card-group").innerHTML + htmlBlock;
        });

      } catch (err) {
        console.log(err)
        artemisAlert.alert('error', 'Something went wrong!')
      }

    }
    window.onload = function() {
      getOrders();
    }

    setInterval(function() {
      getOrders();
    }, 30000);
  </script>
</body>

</html>