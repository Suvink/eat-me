<?php
    require_once './core/Controller.php';
    
    class RatingsReportController extends Controller
    {
        public function __construct()
        {
            require './models/admin/RatingsReportModel.php';
            $this->RatingsReportModel =new RatingsReportModel();
        }
        public function getRatingDetails()
        {
            $result=$this->RatingsReportModel->getAllData('customer_rates_order');
            return $result;
        }
        public function getCustomerId($id)
        {
            $result=$this->RatingsReportModel->getSpecificDataWhere('customerId','order_details','orderId', $id);
            $row= mysqli_fetch_assoc($result);
            $cusId=$row['customerId'];
            return $cusId;
        }
        public function getCustomerName($cusId) 
        {
            $result=$this->RatingsReportModel->getSpecificDataWhere('firstName','customer','customerId', $cusId);
            $row= mysqli_fetch_assoc($result);
            $fname=$row['firstName'];
            return $fname;
        }
    }