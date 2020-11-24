<?php
require_once "./controllers/store/CashierPlaceOrderController.php";
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
        <button class="button is-primary"> Logout </button>
      </div>
    </div>
  </div>
  <button class="button is-primary is-2 mr-1" onclick="returnHome()">Home</button>
  <div class="columns">
    <form action="/" method="POST">
      <div class="column is-4">
        <div class="card">

          <div>
            <label class="field artemis-input-field">
              <input class="artemis-input" type="text" placeholder="Phone Number here" name="phone">
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
          <button class="button is-primary" type="submit">Place Order</button>
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
      console.log(tempItem);
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

<!-- TODO

$str = "'status' => '-1','level1' => '1', 'level2' => '1', 'level9' => '1', 'level10' => '1', 'start' => '2013-12-13', 'stop' => '2013-12-13'";

$mstr = explode(",",$str);
$a = array();
foreach($mstr as $nstr )
{
    $narr = explode("=>",$nstr);
$narr[0] = str_replace("\x98","",$narr[0]);
$ytr[1] = $narr[1];
$a[$narr[0]] = $ytr[1];
}
print_r($a);


array(
$age = array("Peter"=>"35", "Ben"=>"37", "Joe"=>"43");

-->