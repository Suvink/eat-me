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
        public function orderStatus($num){
            switch ($num) {
				case '1':
					return 'Placed';
					break;
				case '2':
					return 'Accepted';
					break;
				case '3':
					return 'Steward_Assigned';
					break;
				case '4':
					return 'DP_Assigned';
					break;
				case '5':
					return 'Prepared';
					break;
				case '6':
					return 'Served';
					break;
				case '7':
					return 'Delivered';
					break;
				case '8':
					return 'Completed';
					break;
				case '9':
					return 'Canceled';
					break;
				default:
					return 'False Status';
			}
        }
        //show order details
        public function renderOrdersDetails($display){
            if($display->num_rows>0){
                while ($row = $display->fetch_assoc()) {
                 $stateOrder=$this->orderStatus($row['orderStatus']);
                echo '<tr>
                        <td>'.$row['orderId'].'</td>
                        <td>'.$row['amount'].'</td>
                        <td>'.$row['paymentType'].'</td>
                        <td>'.$stateOrder.'</td>
                        <td>'.$row['orderType'].'</td>
                        <td>'.$row['customerId'].'</td>
                    </tr>';
                }
            }
        }
        
    }
?>