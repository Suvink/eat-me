<?php
    require_once './core/Controller.php';
    class KitchenDisplayInventoryController extends Controller
    {
        public function __construct()
        {
            require './models/store/KitchenDisplayInventoryModel.php';
            $this->KitchenDisplayInventoryModel = new KitchenDisplayInventoryModel();
        }

        public function getInventoryCount()
        {
            $result=$this->KitchenDisplayInventoryModel->executeSql('SELECT count(*)as total FROM inventory ');
            $row = mysqli_fetch_assoc($result);
            $numItems = $row['total'];
            $displayItems = ($numItems / 3);
            return $displayItems;
        }
        public function getInventoryDetails()
        {
            $result2 = $this->KitchenDisplayInventoryModel->getAllData('inventory');
            return $result2;
        }
        public function sendSearchQuery($searchq)
        {
        
            if($searchq==null)
            {
              return "enter an item name or an item id";
              
            }
            else
            {
                $searchq=preg_replace("#[^0-9a-z]#i","",$searchq);
                $result4=$this->KitchenDisplayInventoryModel->executeSql("SELECT * FROM inventory WHERE itemName LIKE '%$searchq%' OR inventoryId LIKE '%$searchq%' ");
                if ($result4->num_rows <= 0) 
                {
                        echo "<h1 style='display:none'></h1>";
                        echo "<script src='../../plugins/ArtemisAlert/ArtemisAlert.js'></script>";
                        echo '<script> artemisAlert.alert("warning", "No such an Inventory Item!") </script>';
                        return;
                }
                return  $result4;
            }
        }
        public function getRoundOfVal($unitId,$quanityVal)
        {
            if($unitId==3)
            {
                return round($quanityVal) ;
            }
            else
            {
                return $quanityVal;
            }
        }
        public function getMeasurementUnit($munit)
        {
            $result5=$this->KitchenDisplayInventoryModel->getSpecificDataWhere('unitName','units','unitId',$munit);                     
            $row2=mysqli_fetch_assoc($result5);
            $m_unit=$row2['unitName'];
            return $m_unit;
        }
        public function getLastRetrieveData($id)
        {                         
            $result6=$this->KitchenDisplayInventoryModel->executeSql("SELECT  `retrieved_date&time` FROM  `retrieve_stock` WHERE `retrieveId`=(SELECT max(`retrieveId`) FROM `retrieve_stock` WHERE `inventoryId`=$id )");
            $row5=mysqli_fetch_assoc($result6);
            $d=date("Y-m-d",strtotime( $row5['retrieved_date&time']));
            $rDate=null;
            if($d>"2020-1-1")
            {
              $rDate=$d;
            }
            return $rDate;
        }
    }
?>