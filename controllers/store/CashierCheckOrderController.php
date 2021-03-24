<?php
    require_once './core/Controller.php';
    ob_start();
    session_start();
    class CashierCheckOrderController extends Controller
    {
        public function __construct()
        {
            require './models/store/CashierCheckOrderModel.php';
            $this->CashierCheckOrderModel = new CashierCheckOrderModel();
        }
        public function getOrderDetails($searchedId){
            if($searchedId==null){
                $result = $this->CashierCheckOrderModel->getAllData('order_details');    
            }else{
                $result = $this->CashierCheckOrderModel->getAllDataWhere('order_details','orderId',$searchedId);
            }
            return $result;
        }
        public function logout(){
            session_destroy();
            unset($_SESSION['staffId']);
            header("Location: /staff/login",TRUE,302);
          }
    }
?>