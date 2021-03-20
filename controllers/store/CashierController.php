<?php
require_once './core/Controller.php';

class CashierController extends Controller{
    
    function __construct()
    {
      require './models/store/CashierModel.php';
      $this->CashierModel = new CashierModel();
    }
    
    //get table reservation details from database
    public function renderTableReservationDetails($tableNumber){
        $result = $this->CashierModel->getAllDataWhere('table_details','tableNo',$tableNumber);
        $row=mysqli_fetch_assoc($result);
        if($row['reservation']=='Reserved'){
          return true;
        }else{
          return false;
        }
        
    }
    //get ongoing order details from database

    public function renderOngoingOrders(){
      $result = $this->CashierModel->getAllData('order_details');
      $row=mysqli_fetch_assoc($result);
      //$count = $this->CashierModel->executeSql("SELECT COUNT(orderid) FROM order_details;");
      print_r($result);
      die();
      return [$result];

    }
}