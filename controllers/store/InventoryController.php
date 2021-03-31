<?php
    require_once './core/Controller.php';
    $_SESSION['$updatedQuantity']=null;
    class InventoryController extends Controller
    {
        function __construct()
        {
            require './models/store/InventoryModel.php';
            $this->InventoryModel=new InventoryModel();
        }
        public function getInventoryDetails()
        {
            $result=$this->InventoryModel-> executeSql("SELECT * FROM inventory WHERE tag NOT LIKE 'deleted%' ");
            return $result;
        }
        public function getUnits($id)
        {
            $result2=$this->InventoryModel-> getSpecificDataWhere('unitName','units','unitId',$id);
            $row2= mysqli_fetch_assoc($result2);
            $m_unit=$row2['unitName'];
            return $m_unit;
        }
        public function validation($id,$itemName2,$quantity2,$unit2)
        {
            $check=0;
            $result2=$this->InventoryModel-> getSpecificDataWhere('quantity','inventory','inventoryId',$id);
            $row2= mysqli_fetch_assoc($result2);
            $oldQuantity=$row2['quantity'];
            // echo $oldQuantity;
            // echo $quantity2;
            if(is_numeric($quantity2) && $quantity2>=0)
            {
                $_SESSION['$updatedQuantity']=($oldQuantity-$quantity2);
            }
            else
            {
                //echo "updated to old qunantity level";
                echo '<script language="javascript">';
                echo 'alert("'.$id.'"+" "+"'.$itemName2.'"+" " +"updated to old qunantity level")';
                echo '</script>';
                $check=1;
                $_SESSION['$updatedQuantity']=$oldQuantity;
            }
            // if(ctype_alpha(str_replace(' ', '', $itemName2)) === true)
            // {
                 if( $_SESSION['$updatedQuantity']>=0)
                 {
                    $check=1;
                 }
                 else
                 {
                   // echo "can't reduce more than the current amount";
                    echo '<script language="javascript">';
                    echo 'alert("'.$itemName2.'"+" " +"can not reduce more than the current amount"+"\n"+"current amount: "+"'.$oldQuantity.'"+"'.$unit2.'"+"\n"+"try to reduce by :"+"'.$quantity2.'"+"'.$unit2.'")';
                    echo '</script>';
                    $check=0;
                 }
            // }
            // else
            // {
            //     echo "Item name must contains only latters & spaces";
            //     $check=0;
            // }
            return $check;
        }
        public function updateInven($id,$itemName2,$quantity2,$unit2,$unitType2)
        {
            $send=null;
            $send=$this->validation($id,$itemName2,$quantity2,$unit2);
            if($send==1)
            {
                $unitcheck=0;
                if($unit2=="(kg)")
                {
                    if (is_numeric( $_SESSION['$updatedQuantity'])) 
                    {
                        $unitcheck=1;
                    }
                }
                else if($unit2=="(l)")
                {
                    if (is_numeric( $_SESSION['$updatedQuantity'])) 
                    {
                        $unitcheck=1;
                    }
                }
                else if($unit2=="(items)")
                {
                    if (fmod( $_SESSION['$updatedQuantity'], 1) == 0) 
                    {
                        $unitcheck=1;
                    } 
                    else 
                    {
                       // echo "not a whole number";
                       echo '<script language="javascript">';
                       echo 'alert("'.$id.'"+": "+"'.$itemName2.'"+" " +"Input quantity: "+"'.$quantity2.'"+" "+" Updated quantity: "+"'.$_SESSION['$updatedQuantity'].'"+"\n"+"Not a whole number"+"\n"+"updated to old qunantity level")';
                       echo '</script>';
                    }
                }
                else
                {
                    $unitcheck=1;
                }
                if($unitcheck==1)
                {
                    $result2=$this->InventoryModel-> updateData('inventory','inventoryId',$id,array('itemName' => $itemName2, 'quantity' => $_SESSION['$updatedQuantity'], 'unitId' => $unitType2));
                    // echo '<script language="javascript">';
                    // echo 'alert("'.$id.'"+" "+"'.$itemName2.'"+" " +"updated !")';
                    // echo '</script>';
                    return $result2;
                }
            }
            else
            {
                // echo " => Invalid data";
            }
           
        }
        public function getLastReFillDate($id)
        {
            $result3=$this->InventoryModel-> executeSql("SELECT  `date&time` FROM  `add_stock` WHERE `grnNo`=(SELECT max(`grnNo`) FROM `add_stock` WHERE `inventoryId`=$id )");
            $row3= mysqli_fetch_assoc($result3);
            $date=$row3['date&time'];
            $d=strtotime($date);
            $date2=date("Y-m-d h:i:sa", $d);
            if($date2>2020-01-01)
            {
                return $date2;
            }
        }
        public function getLastRetrieveDate($id)
        {
            $result3=$this->InventoryModel-> executeSql("SELECT  `retrieved_date&time` FROM  `retrieve_stock` WHERE `retrieveId`=(SELECT max(`retrieveId`) FROM `retrieve_stock` WHERE `inventoryId`=$id )");
            $row3= mysqli_fetch_assoc($result3);
            $date=$row3['retrieved_date&time'];
            $d=strtotime($date);
            $date2=date("Y-m-d h:i:sa", $d);
            if($date2>2020-01-01)
            {
                return $date2;
            }
            
        }

        public function getNewInventoryID()
        {
            $result=$this->InventoryModel->executeSql('SELECT MAX(inventoryId) FROM inventory');
            $row= mysqli_fetch_assoc($result);
            $val=$row['MAX(inventoryId)'];
            return ($val+1);
        }
        public function addNewItem($itemName3,$id3,$unitid3)
        {
            $result=$this->InventoryModel->writeData("inventory","inventoryId,itemName,unitId","$id3,'$itemName3',$unitid3");
            echo '<script language="javascript">';
            echo 'alert("'.$id3.'"+" "+"'.$itemName3.'"+" " +"Added to the Inventory")';
            echo '</script>';
            return $result;
        }
        public function deleteItem($ans)
        {
            $result2=$this->InventoryModel-> updateData('inventory','inventoryId',$ans,array('flag' =>"deleted"));
            return $result2;
        }

        public function getInventoryLowItem($lowThan)
        {
            $result=$this->InventoryModel-> executeSql("SELECT * FROM `inventory` WHERE quantity < $lowThan");
            return $result;
        }
    }
?>  