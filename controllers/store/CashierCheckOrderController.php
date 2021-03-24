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
        
        //check whether order searched
        public function getOrderDetails($searchedId){
            if($searchedId==""){
                $result = $this->CashierCheckOrderModel->getAllData('order_details');    
            }else{
                $result = $this->CashierCheckOrderModel->getAllDataWhere('order_details','orderId',$searchedId);
            }
            return $result;
        }
        
        //show order details
        public function renderOrdersDetails($display){
            if($display->num_rows>0){
                while ($row = $display->fetch_assoc()) {
                echo '<tr>
                        <td>'.$row['orderId'].'</td>
                        <td>'.$row['amount'].'</td>
                        <td>'.$row['paymentType'].'</td>
                        <td>'.$row['orderStatus'].'</td>
                        <td>'.$row['orderType'].'</td>
                        <td>'.$row['customerId'].'</td>
                    </tr>';
                }
            }
        }
    }
?>