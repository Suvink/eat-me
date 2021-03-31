<?php
    require_once './core/Controller.php';
    
    class SalesReportController extends Controller
    {
        public function __construct()
        {
            require './models/admin/SalesReportModel.php';
            $this->RatingsReportModel =new SalesReportModel();
        }

        public function getOrderDetails()
        {
            $result=$this->RatingsReportModel->getAllData('order_details');
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