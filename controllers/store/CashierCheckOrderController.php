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
							$result=$this->CashierCheckOrderModel->executeSql("SELECT order_details.orderId,order_details.paymentType, customer.firstName, customer.lastName, order_details.orderType, order_details.amount,order_details.orderStatus,menu.itemName,order_includes_menu.qty FROM order_details JOIN customer ON order_details.customerId=customer.customerId JOIN order_includes_menu ON order_details.orderId=order_includes_menu.orderId JOIN menu ON menu.itemNo=order_includes_menu.itemNo");	
							}else{
							$result=$this->CashierCheckOrderModel->executeSql("SELECT order_details.orderId,order_details.paymentType, customer.firstName, customer.lastName, order_details.orderType, order_details.amount,order_details.orderStatus,menu.itemName,order_includes_menu.qty FROM order_details JOIN customer ON order_details.customerId=customer.customerId JOIN order_includes_menu ON order_details.orderId=order_includes_menu.orderId JOIN menu ON menu.itemNo=order_includes_menu.itemNo WHERE order_details.orderId=$searchedId");	
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
								$cusName='';
								$fName=$row['firstName'];
								$searchStr='user-';
                 $stateOrder=$this->orderStatus($row['orderStatus']);
                 if(strpos($fName,$searchStr)!==false){
										$cusName=$row['firstName'];
								 }else{
									$cusName=$row['firstName'].' '. $row['lastName'];
								 }

				echo '<tr>
						<td>' . $row['orderId'] . '</td>
						<td>' . $cusName . '</td>
						<td>' . $row['itemName'] . '</td>
						<td>' . $row['qty'] . '</td>
                        <td>' . $row['paymentType'] . '</td>
                        <td>' . $stateOrder . '</td>
						<td>' . $row['orderType'] . '</td>
						<td>Rs.' . $row['amount'] . '.00</td>                        
                    </tr>';
                }
            }else{	

				print "<center> <div class='artemis-notification notification-danger'><p>Invalid OrderID!</p></div></center>";
			}
        }
        
    }
?>