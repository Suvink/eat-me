<?php
require_once './core/Controller.php';
session_start();
ob_start();

class DineinOrderController extends Controller
{

  private $orderArray;
  private $orderTotal;
  private $itemCounter;

  public function __construct()
  {
    require './models/customer/DineinOrderModel.php';
    $this->DineinOrderModel = new DineinOrderModel();
  }

  public function renderNavBar($phone)
  {
    $result = $this->DineinOrderModel->getAllDataWhere('customer', 'contactNo', $phone);
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

  public function setOrderArray($orderData)
  {
    $this->orderArray = json_decode($orderData);
  }
  public function setorderTotal($totalValue)
  {
    $this->orderTotal = $totalValue;
  }

  public function getCustomerID($phone)
  {
    $result = $this->DineinOrderModel->getAllDataWhere('customer', 'contactNo', $phone);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        return $row['customerId'];
      }
    }
  }

  public function getOrderID()
  {
    $result = $this->DineinOrderModel->executeSql('SELECT * FROM `order_details` ORDER BY `orderId` DESC LIMIT 1');
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo $row['orderId'];
      }
    }else{
      echo 5000;
    }
  }

  public function getUnformattedOrderID()
  {
    $result = $this->DineinOrderModel->executeSql('SELECT * FROM `order_details` ORDER BY `orderId` DESC LIMIT 1');
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        return $row['orderId'] + 1;
      }
    }else{
      //If the table is empty start the order numbering from 5000
      return 5000;
    }
  }

  public function getOrderItems()
  {
    return ($this->orderArray);
  }

  public function getOrderTotal()
  {
    $calculatedTotal = 0;
    foreach ($this->orderArray as $item_price => $item_qty) {
      $result =  $this->DineinOrderModel->getAllDataWhere("menu", "itemNo", $item_price);
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          $calculatedTotal = $calculatedTotal + ($row['price'] * $item_qty);
        }
      } else {
        $calculatedTotal = $calculatedTotal;
      }
    }
    //First check if the order total mathes with the DB. Then Convert to 2 decimal places and return
    if ($calculatedTotal == $this->orderTotal) {
      echo number_format((float)$calculatedTotal, 2, '.', '');
    }
    //TODO: redirect with an error if that doesnt match
  }

  public function renderFinalOrder()
  {
    $counter = 1;
    foreach ($this->orderArray as $item_price => $item_qty) {
      $result =  $this->DineinOrderModel->getAllDataWhere("menu", "itemNo", $item_price);
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          $item_total_price = $item_qty * $row['price'];
          echo ' <input name="item_name_' . $counter . '" value="' . $row['itemName'] . '" style="display:none;">
                <input name="amount_' . $counter . '" value="' . number_format((float)$item_total_price, 2, '.', '') . '" style="display:none;">
                <input name="quantity_' . $counter . '" value="' . $item_qty . '" style="display:none;">
                <input name="item_code_' . $counter . '" value="' . $item_price . '" style="display:none;">';
          $counter++;
        }
      }
    }
    $this->itemCounter = $counter;
  }

  public function getOrderItemsString(){
    $orderString = "";
    foreach ($this->orderArray as $item_price => $item_qty) {
      $result =  $this->DineinOrderModel->getAllDataWhere("menu", "itemNo", $item_price);
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          $orderString = $orderString.$row['itemName']." x".$item_qty.",  ";
        }
      }
    }
    echo $orderString;
  }

  public function getItemCount(){
    //Minus 1 to account for the last increment
    echo $this->itemCounter - 1;
  }

  public function getUserFname($phone)
  {
    $result = $this->DineinOrderModel->getAllDataWhere('customer', 'contactNo', $phone);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo $row['firstName'];
      }
    }
  }

  public function getUserLname($phone)
  {
    $result = $this->DineinOrderModel->getAllDataWhere('customer', 'contactNo', $phone);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo $row['lastName'];
      }
    }
  }

  public function getUserEmail($phone)
  {
    $result = $this->DineinOrderModel->getAllDataWhere('customer', 'contactNo', $phone);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo $row['email'];
      }
    }
  }

  public function setOrderItems($item_no, $item_qty, $order_id)
  {
    $sql = "INSERT INTO `order_includes_menu` (`orderId`, `itemNo`, `qty`, `dateAndTime`) VALUES (".$order_id.",".$item_no.",".$item_qty.",".time().") ";
    //echo $sql;
    $result = $this->DineinOrderModel->executeSql($sql);
    if ($result) {
    }else{
      echo "<script>alert('something went wrong!')</script>";
    }
  }

  public function setDineinOrder($order_id, $tableNo)
  {
    $sql = "INSERT INTO `dine_in_order` (`orderId`, `tableNo`) VALUES (".$order_id.",'".$tableNo."') ";
    //echo $sql;
    $result = $this->DineinOrderModel->executeSql($sql);
    if ($result) {
    }else{
      echo "<script>alert('dinein_order_error!')</script>";
    }
  }

  public function setOrderDetails($order_id, $customer_id, $order_type, $order_total, $payment_type)
  {
    $sql = "INSERT INTO `order_details`(`orderId`, `customerId`, `orderType`, `amount`, `paymentType`, `payment_status`, `timestamp`, `assignedTime`, `preparedTime`, `orderStatus`) VALUES (".$order_id.",".$customer_id.",'".$order_type."',".$order_total.",'".$payment_type."', 'PENDING', ".time().",0,0,1) ";
    $result = $this->DineinOrderModel->executeSql($sql);
    if ($result == TRUE) {
    }else{
      echo "<script>alert('Something went wrong!')</script>";
      //Add a redirect here

    }
  }

  public function getMenuNameById($item_id){
    $result = $this->DineinOrderModel->getAllDataWhere('menu','itemNo', $item_id);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        return $row['itemName'];
      }
    }
  }

  public function getOrderById($order_id){
    $menu_result = $this->DineinOrderModel->getAllDataWhere('order_includes_menu','orderId', $order_id);
      if ($menu_result->num_rows > 0) {
        while ($row = $menu_result->fetch_assoc()) {
          $order_items_array[$row['itemNo']] = $row['qty'];
        }
      }
    return json_encode($order_items_array);
  }

  public function getOrderAmountById($order_id){
    $result = $this->DineinOrderModel->getAllDataWhere('order_details','orderId', $order_id);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        return number_format((float)$row['amount'], 2, '.', '');
      }
    }else{
      return 00.00;
    }
  }

  public function getPaymentMethodById($order_id){
    $result = $this->DineinOrderModel->getAllDataWhere('order_details','customerId', $order_id);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        return $row['paymentType'];
      }
    }
    else{
      return 00.00;
    }
  }
 
  




  
  








}



