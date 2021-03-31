<?php
    require_once './core/Controller.php';
    
    class DashBoardController extends Controller
    {
        public function __construct()
        {
            require './models/admin/DashBoardModel.php';
            $this->DashBoardModel =new DashBoardModel();
        }
        public function getOngoingOrders()
        {
            $result=$this->DashBoardModel-> executeSql("SELECT COUNT(*) FROM order_details WHERE orderStatus!= 8 AND orderStatus!=9;");
            return $result;
        }
        public function getCompletedOrders()
        {
             $result=$this->DashBoardModel-> executeSql("SELECT COUNT(*) FROM order_details WHERE orderStatus = 8;");
             return $result;
        }
        public function getTodaySales()
        {
             $result=$this->DashBoardModel-> executeSql("SELECT order_details.orderId,order_details.amount, date(FROM_UNIXTIME(order_details.timestamp)) as date FROM `order_details`WHERE order_details.timestamp=".time());
             return $result;
        }
       
        
        public function getInventoryDetails()
        {
             
            $sql = "SELECT order_details.orderId,order_details.customerId,order_details.amount,customer.firstName, customer.lastName, order_status.state, date(FROM_UNIXTIME(order_details.timestamp)) as date FROM `order_details` INNER JOIN customer ON order_details.customerId=customer.customerId INNER JOIN order_status ON order_status.statusId=order_details.orderStatus WHERE date(FROM_UNIXTIME(order_details.timestamp))=date(FROM_UNIXTIME(".time()."))";
            $result=$this->DashBoardModel-> executeSql($sql);
            if ($result->num_rows > 0) {
                return $result;
            }
 
        }     
     
    }
?>