<?php
require_once './core/Controller.php';
// session_start();
ob_start();
class KitchenRetrieveController extends Controller
{
    public function __construct()
    {
        require './models/store/KitchenRetrieveModel.php';
        $this->KitchenRetrieveModel = new KitchenRetrieveModel();
    }
    public function sendSearhQuery($searchq)
    {
        if ($searchq == null) {
            return "enter an item name or an item id";
        } else {
            $searchq = preg_replace("#[^0-9a-z]#i", "", $searchq);
            $result = $this->KitchenRetrieveModel->executeSql("SELECT * FROM inventory WHERE itemName LIKE '%$searchq%' OR inventoryId LIKE '%$searchq%'");
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
        $result5=$this->KitchenRetrieveModel->getSpecificDataWhere('unitName','units','unitId',$munit);                     
        $row2=mysqli_fetch_assoc($result5);
        $m_unit=$row2['unitName'];
        return $m_unit;
    }
    public function getInputVal($newq, $oldq, $unitId, $itemId)
    {
        //  echo "item id = " . $_SESSION["itemId"] . "<br>";
        //  echo "new = " . $_SESSION["newq"] . "<br>";
        //  echo "old = " . $_SESSION["oldq"] . "<br>";
        //  echo "unitId = " . $_SESSION["unitId"] . "<br>";
        //  echo date("Y-m-d")."<br>";
        //  echo date("h:i")."<br>";
        date_default_timezone_set("Asia/Colombo");
        $datetime = date("Y-m-d,h:i");
        //  echo $newupdateq."<br>";
        $val = 0;
        if (is_numeric($newq) && $newq >= 0) {
            $newupdateq = ($oldq-$newq);
            if ($oldq >= $newq) {
                if ($unitId == 3) {
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
                // return "can't retreive more than ". $oldq;
                echo "<h1 style='display:none'></h1>";
                echo "<script src='../../plugins/ArtemisAlert/ArtemisAlert.js'></script>";
                echo '<script> artemisAlert.alert("error", "Can not retrieve more than current quentity") </script>';
                return;
            }
        } else {

                echo "<h1 style='display:none'></h1>";
                echo "<script src='../../plugins/ArtemisAlert/ArtemisAlert.js'></script>";
                echo '<script> artemisAlert.alert("error", "Not a Positive Integer") </script>';
                return;
        }
        if ($val == 1) {                                                
            $this->KitchenRetrieveModel->writeData("retrieve_stock","retrieve_quantity,`retrieved_date&time`,inventoryId","$newq,'$datetime',$itemId");
            // $this->KitchenRetrieveModel-> updateData('inventory', 'inventoryId',$itemId, array('quantity'=>$newupdateq));
            $this->KitchenRetrieveModel->executeSql("UPDATE `inventory` SET `quantity`=$newupdateq WHERE inventoryId=$itemId");
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
            echo '<script> artemisAlert.alert("success", "Item: "+"'.$itemId.'"+" "+"Retrieve with "+"'.$newq.'"+" "+"'.$unitName2.'") </script>';
            return;
           

        } else {
            return " <br>data not entered to db";
        }

        
    }
}
