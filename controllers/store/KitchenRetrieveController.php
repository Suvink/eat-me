<?php
require_once './core/Controller.php';
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
                        return "not a whole number";
                    }
                } else if ($unitId == 1) {
                    $val = 1;
                } else if ($unitId == 2) {
                    $val = 1;
                }
            } else {
                return "can't retreive more than ". $oldq;
            }
        } else {

            return "not a positive integer";
        }
        if ($val == 1) {                                                
            $this->KitchenRetrieveModel->writeData("retrieve_stock","retrieve_quantity,`retrieved_date&time`,inventoryId","$newq,'$datetime',$itemId");
            // $this->KitchenRetrieveModel-> updateData('inventory', 'inventoryId',$itemId, array('quantity'=>$newupdateq));
            $this->KitchenRetrieveModel->executeSql("UPDATE `inventory` SET `quantity`=$newupdateq WHERE inventoryId=$itemId");
            return "inserted";
           

        } else {
            return " <br>data not entered to db";
        }

        
    }
}
