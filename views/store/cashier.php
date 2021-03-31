<?php
session_start();
ob_start();

if (!isset($_SESSION['staffId'])) {
  header('Location: /staff/login');
}

require_once './controllers/store/CashierController.php';
$CashierController = new CashierController();

if (isset($_POST['logout'])) {
  $CashierController->logoutstaffMem();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, intial scale=1.0" />
  <!-- Add global styles -->
  <link rel="stylesheet" href="../../css/style.css">
  <link rel="stylesheet" href="../../plugins/ArtemisAlert/ArtemisAlert.css">
  <!-- local styles -->
  <link rel="stylesheet" href="../../css/cashierStyles.css">
  <link rel="icon" type="image/png" href="../../img/favicon.png" />
  <title>Cashier Dashboard </title>

  <!-- //Push Notification Subscription -->
  <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
  <script>
    window.OneSignal = window.OneSignal || [];
    OneSignal.push(function() {
      OneSignal.init({
        appId: "950f0adf-2de5-4613-a7b0-8790f3104caa",
        safari_web_id: 'web.onesignal.auto.20cc36d3-e742-47b9-8fc8-37c27a32926f'
      });
    });
  </script>
</head>

<body>
  <div class="navbar" id="popup-background-1">
    <div class="coloumns group">
      <div class="column is-2">
        <img src="../../img/logo.png" height="56" width="224" />
      </div>
      <div class="column is-10 has-text-right nav-logout">
        <i class="fas fa-user" aria-hidden="true"></i>
        <span class="mr-1">Cashier <?= $_SESSION['staffId'] ?> </span>
        <form class="d-inline" action="/cashier" method="POST">
          <button class="button is-primary" name="logout">Logout</button>
        </form>
      </div>
    </div>
  </div>
  <div class="d-flex justify-content-center" id="popup-background-2">
    <button class="button is-primary is-2 mr-1" onclick="checkOrder()"> Check Orders </button>
    <button class="button is-primary is-2 mr-1" onclick="placeOrder()"> Place Order </button>
    <button class="button is-primary is-2 mr-1" onclick="showSetTableModal()"> Set Table </button>
  </div>
  <div class="coloumns">
    <div class="column is-12">
      <div class="container has-text-centered">
        <div class="card" id="popup-background-3">

          <h1 class="title"> <span class="orange-color">Ongoing</span> Orders </h1>

          <section>
            <?php for ($tnum = 1; $tnum <= 8; $tnum++) { ?>
              <button class="card d-inlineblock table-hover transparent-button mr-3" onclick="showTableDetails(<?= $tnum ?>)" id="table-0<?= $tnum ?>">
                <h2>Table 0<?= $tnum ?> </h2>
              </button>
            <?php }
            ?>

          </section>

          <section class="mt-1 pl-1 pr-1">
            <table id="ongoing-orders-table">
              <thead>
                <tr>
                  <th>Order ID</th>
                  <th>Customer</th>
                  <th>Order Type</th>
                  <th>Amount</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </section>
        </div>
        <?php

        for ($count = 1; $count <= 8; $count++) { ?>
          <section id="section-<?= $count ?>">
            <div class="invisible-box" id="table-description">
              <div class="box-content">
                <span class="close" onclick="closeDetails(<?= $count ?>)">&times;</span>
                <button class="button is-success" id="set-reserve-<?= $count ?>" onclick="reserveTable(<?= $count ?>)">
                  <?php
                  $reservation = $CashierController->renderTableReservationDetails($count);
                  if ($reservation == true) {
                  ?> <script>
                      document.querySelector("#set-reserve-<?= $count ?>").classList.toggle("reserved");
                      document.querySelector("#table-0<?= $count ?>").classList.toggle("reserved");
                    </script>
                  <?php
                    echo 'Reserved';
                  } else echo 'Not Reserved';
                  ?>

                </button>
                <!-- <table>
                  <tr>
                    <td>1001</td>
                  </tr>
                  <tr>
                    <td>Mr.Bean</td>
                  </tr>
                  <tr>
                    <td>Order Status </td>
                  </tr>
                </table> -->
              </div>
            </div>
          </section>
        <?php }

        ?>
      </div>
    </div>
  </div>

  <section id="section-table">
    <div class="invisible-box" id="settable-description">
      <div class="box-content">
        <div class="row">
          <span class="close" onclick="hideSetTableModal()">&times;</span>
        </div>
        <center>
          <p>Set table number on this device</p>
        </center>
      </div>
      <center>
        <label class="field artemis-input-field">
          <input class="artemis-input" type="text" placeholder="Table Number" id="table_number_input" required>
          <span class="label-wrap">
            <span class="label-text">Table Number</span>
          </span>
        </label>
        <button class="button is-primary" onclick="setTableToStorage();"> Set Table </button>
      </center>
    </div>
  </section>

  <script src="../../plugins/ArtemisAlert/ArtemisAlert.js"></script>
  <script src="../../js/store/cashier.js" type="text/javascript"></script>
  <script>
    let closeBtn = document.getElementsByClassName("close");

    window.onload = function() {
      if (localStorage.getItem("table_number")) {
        document.getElementById("table_number_input").value = localStorage.getItem("table_number");
      }
    }
    fetchOrderDetails();
    //refresh table
    setInterval(function() {
      fetchOrderDetails();
    }, 10000);
    
  </script>

</body>



</html>