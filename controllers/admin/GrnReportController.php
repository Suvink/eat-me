<?php
    require_once './core/Controller.php';
    
    class GrnReportController extends Controller
    {
        public function __construct()
        {
            require './models/admin/GrnReportModel.php';
            $this->GrnReportModel =new GrnReportModel();
        }
        public function getGrnDetails($sDate,$endDate)
        {
            $result=$this->GrnReportModel-> executeSql("SELECT * FROM `add_stock` WHERE `date&time`>='$sDate' AND `date&time`<='$endDate'");
            return $result;
        }
        public function getItemName($id)
        {
            $result2=$this->GrnReportModel-> getSpecificDataWhere('itemName','inventory','inventoryId',$id);
            $row2= mysqli_fetch_assoc($result2);
            $name=$row2['itemName'];
            return $name;
        }
        public function getUnitId($id)
        {
            $result2=$this->GrnReportModel-> getSpecificDataWhere('unitId','inventory','inventoryId',$id);
            $row2= mysqli_fetch_assoc($result2);
            $m_unit=$row2['unitId'];
            return $m_unit;
        }
        public function getUnitName($id)
        {
            $result2=$this->GrnReportModel-> getSpecificDataWhere('unitName','units','unitId',$id);
            $row2= mysqli_fetch_assoc($result2);
            $m_unit=$row2['unitName'];
            return $m_unit;
        }
    }
?>