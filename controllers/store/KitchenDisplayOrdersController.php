<?php
require_once './core/Controller.php';

class KitchenDisplayOrdersController extends Controller
{
    public function __construct()
    {
        require './models/store/KitchenDisplayOrdersModel.php';
        $this->KitchenDisplayOrdersModel = new KitchenDisplayOrdersModel();
    }

    // public function gettheCount()
    // {
    //     $result = $this->KitchenDisplayOrdersModel->executeSql('SELECT COUNT(*) FROM `order_details` WHERE orderType="online" AND orderStatus !="9"');
    //     return $result;
    // }
    public function getOrderDetails()
    {
        $result = $this->KitchenDisplayOrdersModel->executeSql('SELECT * FROM `order_details` WHERE orderType="online" AND orderStatus !="9"');
        return $result;
    }
    public function getOrderItems($ans)
    {
        $result = $this->KitchenDisplayOrdersModel->getAllDataWhere('order_includes_menu',' orderId',$ans);
        return $result;
    }
    public function getItemImage($itemNo)
    {
        $result = $this->KitchenDisplayOrdersModel->getSpecificDataWhere('url',' menu','itemNo',$itemNo);
        return $result;
    }
    public function getItemName($itemNo)
    {
        $result = $this->KitchenDisplayOrdersModel->getSpecificDataWhere('itemName',' menu','itemNo',$itemNo);
        return $result;
    }
    public function getTotal($id)
    {
        $result = $this->KitchenDisplayOrdersModel->getSpecificDataWhere('amount','order_details','orderId',$id);
        return $result;
    }
    public function getDateAndTime($id)
    {
        $result = $this->KitchenDisplayOrdersModel->getSpecificDataWhere('timestamp','order_details','orderId',$id);
        return $result;
    }
    public function getAssignedDateAndTime($id)
    {
        $result = $this->KitchenDisplayOrdersModel->getSpecificDataWhere('assignedTime','order_details','orderId',$id);
        return $result;
    }
    public function getPreparedDateAndTime($id)
    {
        $result = $this->KitchenDisplayOrdersModel->getSpecificDataWhere('preparedTime','order_details','orderId',$id);
        return $result;
    }
    public function getAddress($id)
    {
        $result = $this->KitchenDisplayOrdersModel->getSpecificDataWhere('address','online_order','orderId',$id);
        return $result;
    }
    public function updateToAccept($id)
    {
        $result = $this->KitchenDisplayOrdersModel->updateData('order_details','orderId',$id, array('orderStatus' => "2"));
        return $result;
    }
    public function updateToDecline($id)
    {
        $result = $this->KitchenDisplayOrdersModel->updateData('order_details','orderId',$id, array('orderStatus' => "9"));
        return $result;
    }
    public function getOrderStatusBtn($ans)
    {
        $result = $this->KitchenDisplayOrdersModel->getSpecificDataWhere('orderStatus','order_details','orderId',$ans);
        return $result;
    }
    public function getRiders()
    {
        $result = $this->KitchenDisplayOrdersModel->executeSql('SELECT staffId FROM `staff` WHERE roleId="5" AND tag !="deleted"');
        return $result;
        
    }
    public function getRiderStatus($staffId)
    {
        $result = $this->KitchenDisplayOrdersModel->getSpecificDataWhere('status','minor_staff','staffId',$staffId);
        return $result;
    }
    public function riderName($sid)
    {
        $result = $this->KitchenDisplayOrdersModel->getAllDataWhere('staff','staffId',$sid);
        return $result;
    }
    public function orderAssign($assOrId,$assSId, $dateAndTime,$fName)
    {
        $result1 = $this->KitchenDisplayOrdersModel->executeSql("SELECT `orderId` FROM `staff_order` WHERE `staffId`=$assSId");
        $i=1;
        while ($row1 = mysqli_fetch_assoc($result1)) 
        {
            $ordID=$row1['orderId'];
            $result2 = $this->KitchenDisplayOrdersModel->executeSql("SELECT `orderStatus` FROM `order_details` WHERE `orderId`= $ordID");
            $row2=mysqli_fetch_assoc($result2);
            $status=$row2['orderStatus'];
            if($status>3 && $status<6)
            {
                $i++;
                // echo $row1['orderId'];"  ";$row2['orderStatus'];

            }
        }
        if($i<=3)
        {
            $result = $this->KitchenDisplayOrdersModel->writeData("staff_order","orderId,staffId","$assOrId,$assSId");
            date_default_timezone_set("Asia/Colombo");
            $timestamp = date($dateAndTime);
            $timestamp=time();
            // echo date('Y/m/d H:i:s', $timestamp);
            $result = $this->KitchenDisplayOrdersModel->updateData('order_details','orderId',$assOrId, array('orderStatus' => "4",'assignedTime' => $timestamp));
            echo "<h1 style='display:none'></h1>";
            echo "<script src='../../plugins/ArtemisAlert/ArtemisAlert.js'></script>";
            echo '<script> artemisAlert.alert("success", "Rider: "+"'.$assSId.'"+": "+"'.$fName.'"+"  "+" Assigned the order: "+"'.$assOrId.'"+" "+" at: "+"'.$dateAndTime.'") </script>';
            return 1;
               
        }
        else{
            $result = $this->KitchenDisplayOrdersModel->updateData('minor_staff','staffId',$assSId, array('status' => "NOTAVAILABLE"));
                echo "<h1 style='display:none'></h1>";
                echo "<script src='../../plugins/ArtemisAlert/ArtemisAlert.js'></script>";
                echo '<script> artemisAlert.alert("warning", "Rider: "+"'.$assSId.'"+" has arrived to maximum number of orders in row!") </script>';
                return 0;
        }
        
    }
    // public function updateRiderStatus($assSId)
    // {
    //     $result = $this->KitchenDisplayOrdersModel->updateData('minor_staff','staffId',$assSId, array('status' => "NOTAVAILABLE"));
    //     return $result;
    // }
    // public function updateToAssigned($assOrId,$dateAndTime)
    // {
    //     date_default_timezone_set("Asia/Colombo");
    //     $timestamp = date($dateAndTime);
    //     $timestamp=time();
    //     // echo date('Y/m/d H:i:s', $timestamp);
    //     $result = $this->KitchenDisplayOrdersModel->updateData('order_details','orderId',$assOrId, array('orderStatus' => "4",'assignedTime' => $timestamp));
    //     return $result;
    // }
    public function updateToPrepared($orId)
    {
        date_default_timezone_set("Asia/Colombo");
        $datetime2 = date("Y-m-d,h:i");
        $timestamp2 = date($datetime2);
        $timestamp2=time();
        $result = $this->KitchenDisplayOrdersModel->updateData('order_details','orderId',$orId, array('orderStatus' => "5",'preparedTime' => $timestamp2));
        return $result;
    }
}

?>