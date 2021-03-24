<?php
    require_once  './core/Controller.php';

    class KitchenDisplayDineinOrdersController extends Controller
    {
        public function __construct()
        {
            require './models/store/KitchenDisplayDineinOrdersModel.php';
            $this->KitchenDisplayDineinOrdersModel =new KitchenDiplayDineinOrdersModel;
        }
        
        public function getOrderDetails()
        {
            $result = $this->KitchenDisplayDineinOrdersModel->executeSql('SELECT * FROM `order_details` WHERE orderType="di" AND orderStatus !="decline"');
            return $result;
        }
        public function getOrderItems($ans)
        {
            $result = $this->KitchenDisplayDineinOrdersModel->getAllDataWhere('order_includes_menu',' orderId',$ans);
            return $result;
        }
        public function getItemName($itemNo)
        {
            $result = $this->KitchenDisplayDineinOrdersModel->getSpecificDataWhere('itemName',' menu','itemNo',$itemNo);
            return $result;
        }
        public function getTotal($id)
        {
            $result = $this->KitchenDisplayDineinOrdersModel->getSpecificDataWhere('amount','order_details','orderId',$id);
            return $result;
        }
        public function getDateAndTime($id)
        {
            $result = $this->KitchenDisplayDineinOrdersModel->getSpecificDataWhere('dateAndTime','order_includes_menu','orderId',$id);
            return $result;
        }
        public function getAddress($id)
        {
            $result = $this->KitchenDisplayDineinOrdersModel->getSpecificDataWhere('tableNo','dine_in_order','orderId',$id);
            return $result;
        }
        public function updateToAccept($id)
        {
            $result = $this->KitchenDisplayDineinOrdersModel->updateData('order_details','orderId',$id, array('orderStatus' => "accepted"));
            return $result;
        }
        public function updateToDecline($id)
        {
            $result = $this->KitchenDisplayDineinOrdersModel->updateData('order_details','orderId',$id, array('orderStatus' => "decline"));
            return $result;
        }
        public function getOrderStatusBtn($ans)
        {
            $result = $this->KitchenDisplayDineinOrdersModel->getSpecificDataWhere('orderStatus','order_details','orderId',$ans);
            return $result;
        }
        public function getRiders()
        {
            $result = $this->KitchenDisplayDineinOrdersModel->getSpecificDataWhere('staffId','staff','roleId',"3");
            return $result;
        }
        public function getRiderStatus($staffId)
        {
            $result = $this->KitchenDisplayDineinOrdersModel->getSpecificDataWhere('status','minor_staff','staffId',$staffId);
            return $result;
        }
        public function riderName($sid)
        {
            $result = $this->KitchenDisplayDineinOrdersModel->getAllDataWhere('staff','staffId',$sid);
            return $result;
        }
        public function orderAssign($assOrId,$assSId, $dateAndTime,$fName)
        {
            $result = $this->KitchenDisplayDineinOrdersModel->writeData("staff_order","orderId,staffId","$assOrId,$assSId");
        
            echo '<script language="javascript">';
            echo 'alert("'.$assSId.'"+": "+"'.$fName.'"+"  "+" Assigned the order: "+"'.$assOrId.'"+" "+" at: "+"'.$dateAndTime.'")';
            echo '</script>';
            return $result;
        }
        public function updateRiderStatus($assSId)
        {
            $result = $this->KitchenDisplayDineinOrdersModel->updateData('minor_staff','staffId',$assSId, array('status' => "notAvailable"));
            return $result;
        }
        public function updateToAssigned($assOrId)
        {
            $result = $this->KitchenDisplayDineinOrdersModel->updateData('order_details','orderId',$assOrId, array('orderStatus' => "assigned"));
            return $result;
        }
        public function updateToPrepared($orId)
        {
            $result = $this->KitchenDisplayDineinOrdersModel->updateData('order_details','orderId',$orId, array('orderStatus' => "prepared"));
            return $result;
        }
    }
?>