<?php 
    require_once './core/Controller.php';
    class GrnController extends Controller
    {
        function __construct()
        {
            require './models/store/GrnModel.php';
            $this->GrnModel=new GrnModel();
        }
        public function sendSearhQuery($searchq)
        {
            if ($searchq == null) {
                return "enter an item name or an item id";
            } else {
                $searchq = preg_replace("#[^0-9a-z]#i", "", $searchq);
                $result = $this->GrnModel->executeSql("SELECT * FROM inventory WHERE itemName LIKE '%$searchq%' OR inventoryId LIKE '%$searchq%'");
                if ($result->num_rows <= 0) 
                {
                        echo "<h1 style='display:none'></h1>";
                        echo "<script src='../../plugins/ArtemisAlert/ArtemisAlert.js'></script>";
                        echo '<script> artemisAlert.alert("warning", "No such an Inventory Item!") </script>';
                        return;
                }
                return $result;
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
            $result5=$this->GrnModel->getSpecificDataWhere('unitName','units','unitId',$munit);                     
            $row2=mysqli_fetch_assoc($result5);
            $m_unit=$row2['unitName'];
            return $m_unit;
        }
        
        public function getInputVal($newq, $oldq, $unitId, $itemId)
        {
            
            date_default_timezone_set("Asia/Colombo");
            $datetime = date("Y-m-d,h:i");
            //  echo $newupdateq."<br>";
            $val = 0;
            if (is_numeric($newq) && $newq >= 0) 
            {
                $newupdateq = ($oldq + $newq);
                if ($unitId == 3
                ) {
                    if (fmod($newq, 1) == 0) {
                        $val = 1;
                    } else {
                        echo "<h1 style='display:none'></h1>";
                        echo "<script src='../../plugins/ArtemisAlert/ArtemisAlert.js'></script>";
                        echo '<script> artemisAlert.alert("error", "Item count must be a whole number") </script>';
                        return;
                    }
                } else if ($unitId == 1) {
                    $val = 1;
                } else if ($unitId == 2) {
                    $val = 1;
                }
            } else {

                echo "<h1 style='display:none'></h1>";
                echo "<script src='../../plugins/ArtemisAlert/ArtemisAlert.js'></script>";
                echo '<script> artemisAlert.alert("error", "Not a Positive Integer") </script>';
                return;
            }
            if ($val == 1) 
            {                                                
                $this->GrnModel->writeData("add_stock","`added_quntity`,`date&time`,inventoryId","$newq,'$datetime',$itemId");
                // $this->GrnModel-> updateData('inventory', 'inventoryId',$itemId, array('quantity'=>$newupdateq));
                $this->GrnModel->executeSql("UPDATE `inventory` SET `quantity`=$newupdateq WHERE inventoryId=$itemId");
                $unitName2=null;
                if($unitId=="1")
                {
                    $unitName2="(kg)";
                }
                else if($unitId=="2")
                {
                    $unitName2="(l)";
                }
                else if($unitId=="3")
                {
                    $unitName2="(items)";
                }

                echo "<h1 style='display:none'></h1>";
                echo "<script src='../../plugins/ArtemisAlert/ArtemisAlert.js'></script>";
                echo '<script> artemisAlert.alert("success", "Item: "+"'.$itemId.'"+" "+"filled with "+"'.$newq.'"+" "+"'.$unitName2.'") </script>';
                return;

            } 
            else 
            {
                return " <br>data not entered to db";
            }

            
        }

    }
?>