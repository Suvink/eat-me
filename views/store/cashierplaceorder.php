<?php
session_start();
ob_start();

require_once "./controllers/store/CashierPlaceOrderController.php";
$CashierPlaceOrderController = new CashierPlaceOrderController();

if(!isset($_SESSION['staffId'])){
    header('Location: /staff/login');
}

if( isset( $_POST['logout'] ) ){
  $CashierPlaceOrderController->stafflogout();
}

if(isset($_POST['placeorder-btn'])){
  $customerPhone = $_POST['customerPhone'];
  $orderItems = $_POST['items'];
  $CashierPlaceOrderController->placeOrder($customerPhone,$orderItems);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, intial scale=1.0" />
  <!-- Add global styles -->
  <link rel="stylesheet" href="../../css/style.css">
  <!-- local styles -->
  <link rel="stylesheet" href="../../css/cashierPlaceOrderStyles.css">
  <title>Place Order</title>
</head>

<body>
  <div class="navbar" id="popup-background-1">
    <div class="coloumns group">
      <div class="column is-2">
        <img src="../../img/logo.png" height="56" width="224" />
      </div>
      <div class="column is-10 has-text-right nav-logout">
        <i class="fas fa-bicycle" aria-hidden="true"></i>
        <span class="mr-1">User Name</span>
        <form class="d-inline" action="/cashier" method="POST">
          <button class="button is-primary" name="logout">Logout</button>
        </form>
      </div>
    </div>
  </div>
  <button class="button is-primary is-2 mr-1" onclick="returnHome()">Home</button>
  <div class="columns">
    <form action="/cashier/placeorder" method="POST">
      <div class="column is-4">
        <div class="card">

          <div>
            <label class="field artemis-input-field">
              <input class="artemis-input" type="text" placeholder="Phone Number here" name="customerPhone">
              <span class="label-wrap">
                <span class="label-text">Customer's Phone Number</span>
              </span>
            </label>
            <input type="text" name="items" style="display: none;" id="orderItems">
            <label class="field artemis-input-field">
              <input class="artemis-input" type="text" placeholder="Item Code Here" id="addItem">
              <span class="label-wrap">
                <span class="label-text">Item Code</span>
              </span>
            </label>
            <label class="field artemis-input-field">
              <input class="artemis-input" type="text" placeholder="Quantity Here" id="addQuantity">
              <span class="label-wrap">
                <span class="label-text">Quantity</span>
              </span>
            </label>
            <button class="button is-primary" type="button" onclick="addMenuItems()">Add Item</button>
          </div>
        </div>
      </div>

      <div class="column is-3">
        <div class="card">
          <center>
            <table id="itemDisplay">
              <tr>
                <td>Item Name</td>
                <td>Qty</td>
              </tr>
            </table>
          </center>

          <span>Total Amount Rs.500</span> <br>
          <button class="button is-primary" type="submit" name="placeorder-btn">Place Order</button>
          <button class="button is-danger">Cancel Order</button>
        </div>

      </div>
    </form>
    <div class="column is-5">
      <div class="card">
        <table>
          <thead>
            <tr>
              <th>Item ID</th>
              <th>Item Name</th>
              <th>Price</th>
              <th>Availability</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1001</td>
              <td>Chicken Fried Rice</td>
              <td>LKR 230.00</td>
              <td> Available</td>
            </tr>
            <tr>
              <td>1001</td>
              <td>Chicken Fried Rice</td>
              <td>LKR 230.00</td>
              <td> Available</td>
            </tr>
            <tr>
              <td>1001</td>
              <td>Chicken Fried Rice</td>
              <td>LKR 230.00</td>
              <td> Available</td>
            </tr>
            <tr>
              <td>1001</td>
              <td>Chicken Fried Rice</td>
              <td>LKR 230.00</td>
              <td> Available</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <script>
    let arrayBase = '';

    function returnHome() {
      window.location.href = '/cashier';
    }

    function addMenuItems() {
      let itemId = document.getElementById('addItem').value.toString();
      let itemQty = document.getElementById('addQuantity').value.toString();
      let tempItem = arrayBase + '"' + itemId + '"' + '=>' + '"' + itemQty + '",';
      arrayBase = tempItem;
      document.getElementById("orderItems").value = arrayBase;
      console.log(arrayBase);
      addItemsToTable(itemId, itemQty);
    }

    function addItemsToTable(itemId, itemQty) {
      let tableBase = document.getElementById("itemDisplay");
      let tableRow = tableBase.insertRow(tableBase.rows.length++);
      let leftCell = tableRow.insertCell(0);
      let rightCell = tableRow.insertCell(1);
      leftCell.innerHTML = itemId;
      rightCell.innerHTML = itemQty;
    }
  </script>
</body>

</html>
