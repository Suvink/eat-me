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
            $result=$this->DashBoardModel-> executeSql("SELECT COUNT(*) FROM order_status WHERE state = 'Placed' OR state = 'Accepted' OR state = 'Steward_assigned' OR state = 'DP_assigned' OR state = 'Prepared' OR state = 'Served';");
            return $result;
        }
        public function getCompletedOrders()
        {
             $result=$this->DashBoardModel-> executeSql("SELECT COUNT(*) FROM order_status WHERE state = 'Completed';");
             return $result;
        }
        // public function getCompletedOrders($state)
        // {
        //     $result=$this->DashBoardModel-> executeSql("SELECT COUNT(IF(state='Completed',1, NULL)) 'Completed' FROM order_status ;");
        //     return $result;
        // }
        public function getCustomerName($customerId)
        {
            $result=$this->DashBoardModel-> executeSql("SELECT * FROM customer WHERE customerId = '$customerId' ");
            return $result;
        }
        public function getItems($orderId)
        {
            $result=$this->DashBoardModel-> executeSql("SELECT itemNo FROM order_includes_menu WHERE orderId = '$orderId' ");
            return $result;
        }
        public function getItemName($itemNo)
        {
            $result=$this->DashBoardModel-> executeSql("SELECT itemName FROM menu WHERE itemNo = '$itemNo' ");
            return $result;
        }
        public function getOrderState($orderStatus)
        {
            $result=$this->DashBoardModel-> executeSql("SELECT * FROM order_status WHERE statusId = '$orderStatus' ");
            return $result;
        }
        public function getInventoryDetails()
        {
            
            // date_default_timezone_set("Asia/Colombo");
            // $datetime = date("Y-m-d");
            // ada dineta thiyna all details
            // $result=$this->DashBoardModel-> executeSql("SELECT * FROM order_details WHERE timespam = ");
            // return $result;
 
            date_default_timezone_set("Asia/Colombo");
            $today = date('Y-m-d');
            $sql = "SELECT order_details.orderId,order_details.customerId,order_details.orderStatus,order_details.amount,customer.firstName, customer.lastName, date(FROM_UNIXTIME(order_details.timestamp)) as date FROM `order_details` INNER JOIN customer ON order_details.customerId=customer.customerId WHERE order_details.timestamp=".time();
            
            $result=$this->DashBoardModel-> executeSql($sql);
           
            $row = mysqli_fetch_assoc($result);
            if ($result->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($result)){
                if($row['timestamp']==$today){
                    return $result;
                }
                
            }
        }
           
            

            // $today = date('Y-m-d');
            // $query = mysql_query("SELECT field FROM table WHERE DATE(column) = '$today'");
            
     }
    }
?>