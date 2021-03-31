<?php
    require_once './core/Controller.php';
    
    class SalesReportController extends Controller
    {
        public function __construct()
        {
            require './models/admin/SalesReportModel.php';
            $this->RatingsReportModel =new SalesReportModel();
        }

        public function getOrderDetails($s_date, $e_date)
        {
            $result=$this->RatingsReportModel->executeSql("SELECT * from order_details WHERE date(FROM_UNIXTIME(order_details.timestamp)) BETWEEN '".$s_date."' AND '".$e_date."'");
            return $result;
        }

        public function getCustomerName($cusId) 
        {
            $result=$this->RatingsReportModel->getAllDataWhere('customer','customerId', $cusId);
            $row= mysqli_fetch_assoc($result);
            $name=$row['firstName']." ".$row['lastName'];
            return $name;
        }


    }