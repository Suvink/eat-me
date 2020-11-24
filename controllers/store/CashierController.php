<?php
require_once './core/Controller.php';

class CashierController extends Controller{
    
    function __construct()
    {
      require './models/store/CashierModel.php';
      $this->CashierModel = new CashierModel();
    }
    // public function setTableNumber($Number){
    //     $this->tableNumber=$Number;
    // }

    public function renderTableReservationDetails($tableNumber){
        $result = $this->CashierModel->getAllDataWhere('table_details','tableNo',$tableNumber);
        $row=mysqli_fetch_assoc($result);
        return $row['reservation'];
    }
}