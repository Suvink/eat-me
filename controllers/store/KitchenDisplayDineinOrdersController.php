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
            $result = $this->KitchenDisplayDineinOrdersModel->executeSql('SELECT * FROM `order_details` WHERE orderType="dinein" AND orderStatus !="9"');
            return $result;
        }
        public function getOrderItems($ans)
        {
            $result = $this->KitchenDisplayDineinOrdersModel->getAllDataWhere('order_includes_menu',' orderId',$ans);
            return $result;
        }
        public function getItemImage($itemNo)
        {
            $result = $this->KitchenDisplayDineinOrdersModel->getSpecificDataWhere('url',' menu','itemNo',$itemNo);
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
            $result = $this->KitchenDisplayDineinOrdersModel->getSpecificDataWhere('timestamp','order_details','orderId',$id);
            return $result;
        }
        public function getAssignedDateAndTime($id)
        {
            $result = $this->KitchenDisplayDineinOrdersModel->getSpecificDataWhere('assignedTime','order_details','orderId',$id);
            return $result;
        }
        public function getPreparedDateAndTime($id)
        {
            $result = $this->KitchenDisplayDineinOrdersModel->getSpecificDataWhere('preparedTime','order_details','orderId',$id);
            return $result;
        }
        public function getAddress($id)
        {
            $result = $this->KitchenDisplayDineinOrdersModel->getSpecificDataWhere('tableNo','dine_in_order','orderId',$id);
            return $result;
        }
        public function updateToAccept($id)
        {
            $result = $this->KitchenDisplayDineinOrdersModel->updateData('order_details','orderId',$id, array('orderStatus' => "2"));
            return $result;
        }
        public function updateToDecline($id)
        {
            $result = $this->KitchenDisplayDineinOrdersModel->updateData('order_details','orderId',$id, array('orderStatus' => "9"));
            return $result;
        }
        public function getOrderStatusBtn($ans)
        {
            $result = $this->KitchenDisplayDineinOrdersModel->getSpecificDataWhere('orderStatus','order_details','orderId',$ans);
            return $result;
        }
        public function getRiders()
        {
            $result = $this->KitchenDisplayDineinOrdersModel->executeSql('SELECT staffId FROM `staff` WHERE roleId="3" AND tag !="deleted"');
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
            $result = $this->KitchenDisplayDineinOrdersModel->updateData('minor_staff','staffId',$assSId, array('status' => "NOTAVAILABLE"));
            return $result;
        }
        public function updateToAssigned($assOrId,$dateAndTime)
        {
            date_default_timezone_set("Asia/Colombo");
            $timestamp = date($dateAndTime);
            $timestamp=time();
            // echo date('Y/m/d H:i:s', $timestamp);
            $result = $this->KitchenDisplayDineinOrdersModel->updateData('order_details','orderId',$assOrId, array('orderStatus' => "3",'assignedTime' => $timestamp));
            return $result;
        }
        public function updateToPrepared($orId)
        {
            date_default_timezone_set("Asia/Colombo");
            $datetime2 = date("Y-m-d,h:i");
            $timestamp2 = date($datetime2);
            $timestamp2=time();
            $result = $this->KitchenDisplayDineinOrdersModel->updateData('order_details','orderId',$orId, array('orderStatus' => "5",'preparedTime' => $timestamp2));
            return $result;
        }
        
    }
?>