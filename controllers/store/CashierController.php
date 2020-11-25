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
        if($row['reservation']=='Reserved'){
          return true;
        }else{
          return false;
        }
        
    }
    public function logout(){
      session_destroy();
      unset($_SESSION['staffId']);
      header("Location: /staff/login",TRUE,302);
    }
}