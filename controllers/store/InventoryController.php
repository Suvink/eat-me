<?php
    require_once './core/Controller.php';
    class InventoryController extends Controller
    {
        function __construct()
        {
            require './models/store/InventoryModel.php';
            $this->InventoryModel=new InventoryModel();
        }
        public function getInventoryDetails()
        {
            $result=$this->InventoryModel->getAllData('inventory');
            return $result;
        }
        public function getUnits($id)
        {
            $result2=$this->InventoryModel-> getSpecificDataWhere('unitName','units','unitId',$id);
            $row2= mysqli_fetch_assoc($result2);
            $m_unit=$row2['unitName'];
            return $m_unit;
        }
    }
?>  