<?php

require_once './core/Controller.php';

class OnlineCustomerProfileController extends Controller{

  function __construct()
  {
    require './models/customer/OnlineCustomerProfileModel.php';
    $this->OnlineCustomerProfileModel = new OnlineCustomerProfileModel();
    
  }


  public function renderNavBar($phone)
  {
    $result = $this->OnlineCustomerProfileModel->getAllDataWhere('customer', 'contactNo', $phone);
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

  public function getFName($phone)
  {
    $result = $this->OnlineCustomerProfileModel->getAllDataWhere('customer', 'contactNo', $phone);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo $row['firstName'];
      }
    }
  }

  public function getLName($phone)
  {
    $result = $this->OnlineCustomerProfileModel->getAllDataWhere('customer', 'contactNo', $phone);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo $row['lastName'];
      }
    }
  }

  public function getEmail($phone)
  {
    $result = $this->OnlineCustomerProfileModel->getAllDataWhere('customer', 'contactNo', $phone);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo $row['email'];
      }
    }
  }

  public function getCustomerID($phone)
  {
    $result = $this->OnlineCustomerProfileModel->getAllDataWhere('customer', 'contactNo', $phone);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        return $row['customerId'];
      }
    }
  }

  public function setProfileData($fname, $lname, $emailaddr, $phone)
  {
    //Editing the user info will activate the account.
    //State change => PROVISIONED > ACTIVE
    $sql = "UPDATE `customer` SET `firstName`='".$fname."', `lastName`='".$lname."', `email`='".$emailaddr."',profileType='ACTIVE' WHERE `contactNo`='".$phone."'";
    $result = $this->OnlineCustomerProfileModel->executeSql($sql);
    if ($result) {
      echo "<script src='../../plugins/ArtemisAlert/ArtemisAlert.js'></script>";
      echo "<script>window.onload = function() {artemisAlert.alert('success', 'Profile Updated!')};</script>";
    }else{
      echo "<script src='../../plugins/ArtemisAlert/ArtemisAlert.js'></script>";
      echo "<script>window.onload = function() {artemisAlert.alert('error', 'Could not update the profile!')};</script>";
    }
  }

  public function setOrderItems($item_no, $item_qty, $order_id)
  {
    $sql = "INSERT INTO `order_includes_menu` (`orderId`, `itemNo`, `qty`, `dateAndTime`) VALUES (".$order_id.",".$item_no.",".$item_qty.",".time().") ";
    $result = $this->OnlineCustomerProfileModel->executeSql($sql);
    if ($result) {
      $notification_string = 'You have a new order! Order ID: #'.$order_id;
      $this->sendPushNotification($notification_string);
    }else{
      echo "<script>alert('something went wrong!')</script>";
    }
  }

  public function setOnlineOrder($order_id, $address, $delivery_fee)
  {
    $sql = "INSERT INTO `online_order` (`orderId`, `address`, `delivery_fee`) VALUES (".$order_id.",'".$address."',".$delivery_fee.") ";
    $result = $this->OnlineCustomerProfileModel->executeSql($sql);
    if ($result) {
    }else{
      echo "<script>alert('online_order_error!')</script>";
    }
  }

  public function setOrderDetails($order_id, $customer_id, $order_type, $order_total, $payment_type)
  {
    $sql = "INSERT INTO `order_details`(`orderId`, `customerId`, `orderType`, `amount`, `paymentType`, `payment_status`, `timestamp`, `assignedTime`, `preparedTime`, `orderStatus`) VALUES (".$order_id.",".$customer_id.",'".$order_type."',".$order_total.",'".$payment_type."', 'PENDING', ".time().",0,0,1) ";
    $result = $this->OnlineCustomerProfileModel->executeSql($sql);
    if ($result == TRUE) {
    }else{
      echo "<script>alert('Something went wrong!')</script>";
      //Add a redirect here

    }
  }


  

}

?>
