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
}