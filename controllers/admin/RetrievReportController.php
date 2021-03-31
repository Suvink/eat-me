<?php
    require_once './core/Controller.php';
    
    class RetrievReportController extends Controller
    {
        public function __construct()
        {
            require './models/admin/RetrievReportModel.php';
            $this->RetrievReportModel =new RetrievReportModel();
        }
        public function getRetrieveDetails($sDate,$endDate)
        {
            $result=$this->RetrievReportModel-> executeSql("SELECT * FROM `retrieve_stock` WHERE `retrieved_date&time`>='$sDate' AND `retrieved_date&time`<='$endDate'");
            return $result;
        }
        public function getItemName($id)
        {
            $result2=$this->RetrievReportModel-> getSpecificDataWhere('itemName','inventory','inventoryId',$id);
            $row2= mysqli_fetch_assoc($result2);
            $name=$row2['itemName'];
            return $name;
        }
       
        public function getUnitId($id)
        {
            $result2=$this->RetrievReportModel-> getSpecificDataWhere('unitId','inventory','inventoryId',$id);
            $row2= mysqli_fetch_assoc($result2);
            $m_unit=$row2['unitId'];
            return $m_unit;
        }
        public function getUnitName($id)
        {
            $result2=$this->RetrievReportModel-> getSpecificDataWhere('unitName','units','unitId',$id);
            $row2= mysqli_fetch_assoc($result2);
            $m_unit=$row2['unitName'];
            return $m_unit;
        }

    }