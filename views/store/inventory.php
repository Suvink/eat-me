<?php
session_start();
ob_start();
$staffid = $_SESSION['staffId'];
$name_first = $_SESSION['firstName'];
$name_last = $_SESSION['lastName'];
$roleId = $_SESSION['roleId'];
require_once './controllers/store/InventoryController.php';
$InventoryController = new InventoryController();

if (isset($_POST['logout'])) {
    $InventoryController->logoutstaffMem();
}
if (isset($_POST['updateInven'])) {
    $_SESSION['lastUpdated'] = $_POST['id2'];
    $itemID2 = $_POST['id2'];
    $itemName2 = $_POST['itemName2'];
    $quantity2 = $_POST['quantity2'];
    $unit2 = $_POST['unit2'];
    $unitType2 = $_POST['unitType2'];
    $InventoryController->updateInven($itemID2, $itemName2, $quantity2, $unit2, $unitType2);
}
$style2 = "style=display:none";
$newID = null;
if (isset($_POST['addNewItem'])) {
    $style2 = "style=display:block";
    $newID = $InventoryController->getNewInventoryID();
}

function ext($i_id)
{
    $itemID = $i_id;
    return $itemID;
}
$style = "style=display:none";
$inventoryId = null;
$itemName = null;
$quantity = null;
$unitId = null;
$reFillDate = null;
$retrieveDate = null;
if (isset($_POST['updatePopUp'])) {
    $style = "style=display:block";
    $ans = ext($_REQUEST['updatePopUp']);

    $inventoryId = $_POST['inventoryId'];
    $itemName = $_POST['itemName'];
    $quantity = $_POST['quantity'];
    $unitId = $_POST['unitId'];
    $takeUnitId = $_POST['takeUnitID'];
    $reFillDate = $_POST['refillDate'];
    $retrieveDate = $_POST['retrieveDate'];
    //echo $inventoryId,$itemName,$quantity,$unitId,$reFillDate,$retrieveDate;
}
if (isset($_POST['addItem'])) {
    $itemName3 = $_POST['itemName3'];
    $id3 = $_POST['id3'];
    $unitid3 = $_POST['unitType'];
    $InventoryController->addNewItem($itemName3, $id3, $unitid3);
}
if (isset($_POST['delete'])) {
    $ans = ext($_REQUEST['delete']);
    $InventoryController->deleteItem($ans);
}
$style3 = "style=display:none";
if (isset($_POST['runingLowItem'])) {
    $style3 = "style=display:block";
}
$style4 = "";
$style5 = "";
$style6 = "style=display:none";
$resultLowItems = null;
if (isset($_POST['go'])) {
    $lowThan = $_POST['lowThan'];
    if (is_numeric($lowThan)) {
        $style4 = "style=display:none";
        $style5 = "style=display:none";
        $style6 = "style=display:block";
        $resultLowItems = $InventoryController->getInventoryLowItem($lowThan);
    } else {
        echo '<script language="javascript">';
        echo 'alert("Not and Integer")';
        echo '</script>';
    }
}
$styleRepotPopOne = "style=display:none";
$styleGRNCreateRepoBtn = "style=display:none";
$styleRetCreateRepoBtn = "style=display:none";
$topic=null;
if (isset($_POST['GRN-Report'])) {
    $styleRepotPopOne = "style=display:display";
    $topic="GRN";
    $styleGRNCreateRepoBtn = "style=display:display";
}
if (isset($_POST['createGrnReport'])) {
   $_SESSION['startDate']=$_POST['startDate'];
   $_SESSION['endDate']=$_POST['endDate'];
   $_SESSION['reportName']="GRN";
   header('Location: ./grnreport');
}
if (isset($_POST['Retrieve-Report'])) {
    $styleRepotPopOne = "style=display:display";
    $topic="Retrieve";
    $styleRetCreateRepoBtn = "style=display:display";
}
if (isset($_POST['changeImage'])) {
    $_SESSION['imgeUploadTo']="inventory";
    $_SESSION['idUpload']=$_POST['id2'];
    $_SESSION['itemNameUpload']=$_POST['itemName2'];
    $_SESSION['uploadStatus']="manage";
    header('Location: ./imageuploader');
 }
if (isset($_POST['ratings'])) {
    header('Location: ./ratingsreport');
 }
if (isset($_POST['saleReports'])) {
    header('Location: ./salesreport');
 }

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Global Styles -->
    <link rel="stylesheet" href="../../css/style.css" />
    <!-- Local Styles -->
    <link rel="stylesheet" href="../../css/kitchendisplay.css">
    <link rel="stylesheet" href="../../css/kitcheninventory.css">
    <link rel="stylesheet" href="../../css/inventory.css">
    <link rel="stylesheet" href="../../css/adminMenuUpdate.css">
    <link rel="stylesheet" href="../../css/kitchenMenuUpdate.css">
    <link rel="stylesheet" href="../../plugins/ArtemisAlert/ArtemisAlert.css">
    <title>Inventory</title>
    <!-- <script type="text/javascript" src="../../js/kitchendisplay.js"></script> -->

</head>
<script src="../../plugins/ArtemisAlert/ArtemisAlert.js"></script>


<body>
    <!-- -----navi bar ---------- -->
    <form action="" method="POST">
        <div class="navbar">
            <div class="columns group">
                <div class="column is-2">
                    <img src="../../img/logo.png" height=56 width="224" />
                </div>
                <div class="column is-6 ml-5"></div>
                <div class="column is-3 has-text-right nav-logout">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <span class="mr-1"><?php echo $staffid ?></span>
                    <span class="mr-1"><?php echo $name_first, " ", $name_last ?></span>
                    <button class="button is-primary" name="logout">Logout</button>
                </div>
            </div>
        </div>
    </form>
    <!--------xx-----navi bar --------xx------->
    <!----------- navigatable buttons------------>
    <?php
    if ($roleId == "1") {
    ?>
        <section>
            <div class="row buttons-row">
                <a href="/admin">
                    <button class="button is-primary  right-radius idle">Dash Board</button>
                </a>
                <a href="/inventory">
                    <button class="button is-primary button-is-active  left-radius right-radius idle">Inventory</button>

                </a>
                <a href="/grn">
                    <button class="button is-primary left-radius right-radius idle">GRN</button>
                </a>
                <a href="/admin/menu/update">
                    <button class="button is-primary left-radius right-radius idle">Menu</button>
                </a>
                <a href="/admin/staffmanage">
                    <button class="button is-primary  left-radius idle">Staff Manage</button>
                </a>
            </div>
        </section>
    <?php
    } else {
        $InventoryController->logoutstaffMem();
    }
    ?>
    <!-----XX------ navigatable buttons-----XX------->
    <!----------------inventory container---------------->
    <div class="columns group">
        <div class="column is-8">
            <div class="inventory-container">
                <div class="box">
                    <div class="s-box">
                        <table class="inventory-table" <?php echo $style5; ?>>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th colspan="2">Quantity</th>
                                <th>Last-refill Date</th>
                                <th>Last-retrieve Date</th>
                                <th>Update</th>
                                <th>Delete</th>
                            </tr>
                            <?php
                            $result = $InventoryController->getInventoryDetails();
                            while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                <tr>
                                    <form action="" method="POST">
                                        <td><input name="inventoryId" type="hidden" value="<?php echo $row['inventoryId']; ?>"><?php echo $row['inventoryId']; ?></td>
                                        <td><input name="itemName" type="hidden" value="<?php echo $row['itemName']; ?>"><?php echo $row['itemName']; ?></td>
                                        <td id="align-right"><input name="quantity" type="hidden" value="<?php echo $row['quantity']; ?>"><?php echo $row['quantity']; ?></td>
                                        <td id="adjust-width"><input name="unitId" type="hidden" value="<?php echo "(" . $InventoryController->getUnits($row['unitId']) . ")"; ?>"> <?php echo "(" . $InventoryController->getUnits($row['unitId']) . ")"; ?> </td>
                                        <input type="hidden" name="takeUnitID" value="<?php echo $row['unitId']; ?>">
                                        <td class="date-width"><input name="refillDate" type="hidden" value="<?php echo $InventoryController->getLastReFillDate($row['inventoryId']); ?>"> <?php echo $InventoryController->getLastReFillDate($row['inventoryId']); ?></td>
                                        <td class="date-width"><input name="retrieveDate" type="hidden" value="<?php echo $InventoryController->getLastRetrieveDate($row['inventoryId']); ?>"><?php echo $InventoryController->getLastRetrieveDate($row['inventoryId']); ?></td>
                                        <td id="stuff"><button name="updatePopUp" value="<?php echo $row['inventoryId']; ?>" class="visibility-hide zoom" onclick="showDropDow()">update</button></td>
                                        <td id="stuff"><button name="delete" value="<?php echo $row['inventoryId']; ?>" class="visibility-hide zoom " onclick="return confirm('Are you sure you want to delete this item?');">delete</button></td>
                                    </form>
                                </tr>
                            <?php
                            }
                            ?>
                        </table>
                        <table class="inventory-table" <?php echo $style6; ?>>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th colspan="2">Quantity</th>
                                <th>Last-refill Date</th>
                                <th>Last-retrieve Date</th>
                                <th>Update</th>
                                <th>Delete</th>
                            </tr>
                            <?php
                            if ($resultLowItems != null) {
                                while ($row = mysqli_fetch_assoc($resultLowItems)) {
                            ?>
                                    <tr>
                                        <form action="" method="POST">
                                            <td><input name="inventoryId" type="hidden" value="<?php echo $row['inventoryId']; ?>"><?php echo $row['inventoryId']; ?></td>
                                            <td><input name="itemName" type="hidden" value="<?php echo $row['itemName']; ?>"><?php echo $row['itemName']; ?></td>
                                            <td id="align-right"><input name="quantity" type="hidden" value="<?php echo $row['quantity']; ?>"><?php echo $row['quantity']; ?></td>
                                            <td id="adjust-width"><input name="unitId" type="hidden" value="<?php echo "(" . $InventoryController->getUnits($row['unitId']) . ")"; ?>"> <?php echo "(" . $InventoryController->getUnits($row['unitId']) . ")"; ?> </td>
                                            <input type="hidden" name="takeUnitID" value="<?php echo $row['unitId']; ?>">
                                            <td class="date-width"><input name="refillDate" type="hidden" value="<?php echo $InventoryController->getLastReFillDate($row['inventoryId']); ?>"> <?php echo $InventoryController->getLastReFillDate($row['inventoryId']); ?></td>
                                            <td class="date-width"><input name="retrieveDate" type="hidden" value="<?php echo $InventoryController->getLastRetrieveDate($row['inventoryId']); ?>"><?php echo $InventoryController->getLastRetrieveDate($row['inventoryId']); ?></td>
                                            <td id="stuff"><button name="updatePopUp" value="<?php echo $row['inventoryId']; ?>" class="visibility-hide zoom" onclick="showDropDow()">update</button></td>
                                            <td id="stuff"><button name="delete" value="<?php echo $row['inventoryId']; ?>" class="visibility-hide zoom " onclick="return confirm('Are you sure you want to delete this item?');">delete</button></td>
                                        </form>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="column is-4">
            <div class="box-2">
                <form action="" method="POST">
                    <div class="s-box-2 dropdown">
                        <h3>Last Updated Item <?php echo $_SESSION['lastUpdated']; ?></h3>
                        <div class="dropdown-content" id="dropDown" <?php echo $style; ?>>
                            <div class="columns group">
                                <div class="column is-6 font">
                                    Id :
                                </div>
                                <div class="column is-6 font">
                                    <input type="hidden" name="id2" value="<?php echo $inventoryId; ?>">
                                    <?php echo $inventoryId; ?>
                                </div>
                            </div>
                            <div class="columns group">
                                <div class="column is-1 font">
                                </div>
                                <div class="column is-5 font adjust-margins artemis-input-field ">
                                    <b><input class="artemis-input zoom text-align" type="text" placeholder="Item Name" name="itemName2" value="<?php echo $itemName; ?>" required>
                                        <span class="label-wrap">
                                            <span class="label-text">Item Name</span>
                                        </span></b>
                                </div>
                                <div class="column is-5 font adjust-margins ml-2 artemis-input-field ">
                                    <?php
                                    if ($takeUnitId == 1) {
                                    ?>
                                        <span> (Kg)<input type="radio" name="unitType2" value="1" checked required></span>
                                        <span> (l)<input type="radio" name="unitType2" value="2" required></span>
                                        <span>(items)<input type="radio" name="unitType2" value="3" required></span>
                                    <?php
                                    } else if ($takeUnitId == 2) {
                                    ?>
                                        <span> (Kg)<input type="radio" name="unitType2" value="1" required></span>
                                        <span> (l)<input type="radio" name="unitType2" value="2" checked required></span>
                                        <span>(items)<input type="radio" name="unitType2" value="3" required></span>
                                    <?php
                                    } else if ($takeUnitId == 3) {
                                    ?>
                                        <span> (Kg)<input type="radio" name="unitType2" value="1" required></span>
                                        <span> (l)<input type="radio" name="unitType2" value="2" required></span>
                                        <span>(items)<input type="radio" name="unitType2" value="3" checked required></span>
                                    <?php
                                    } else {
                                    ?>
                                        <span> (Kg)<input type="radio" name="unitType2" value="1" required></span>
                                        <span> (l)<input type="radio" name="unitType2" value="2" required></span>
                                        <span>(items)<input type="radio" name="unitType2" value="3" required></span>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="columns group">
                                <div class="column is-1 font">
                                </div>
                                <div class="column is-11 font adjust-margins artemis-input-field ">

                                    <b><input class="artemis-input zoom text-align" name="quantity2" type="text" placeholder="Reduce Qunatity By"><?php echo $unitId; ?>
                                        <!-- <input type="hidden" name="quantity2" value="<?php echo $quantity; ?>"> -->
                                        <input type="hidden" name="unit2" value="<?php echo $unitId; ?>">
                                    </b>
                                    <!-- <span class="label-wrap">
                                    <span class="label-text">Reduce</span>
                                </span></b> -->
                                </div>
                            </div>
                            <div class="columns group ">
                                <div class="column is-6 font">
                                    Refill Date :
                                </div>
                                <div class="column is-6 font">
                                    <?php echo $reFillDate; ?>
                                </div>
                            </div>
                            <div class="columns group ">
                                <div class="column is-6 font">
                                    Retrieve Date :
                                </div>
                                <div class="column is-6 font">
                                    <?php echo $retrieveDate; ?>
                                </div>
                            </div>
                            <div class="columns group">
                                <div class="column is-12">
                                    <button name="updateInven" class="width-adjust zoom">Update</button>

                                </div>
                            </div>
                            <div class="columns group">
                                <div class="column is-12">
                                    <button name="changeImage" class="is-primary zoom width-adjust">Change Images</button>
                                </div>
                            </div>
                            <div class="columns group">
                                <div class="column is-12">
                                    <button class="width-adjust zoom">Up</button>
                                </div>
                            </div>
                        </div>
                </form>
            </div>

        </div>
        <div class="box-2">
            <form action="" method="POST">
                <div class="s-box-2 adjust-height">
                    <div class="columns group">
                        <div class="column is-12">
                            QUICK ACCESS
                        </div>
                    </div>
                    <div class="columns group">
                        <div class="column is-12">
                            <button name="addNewItem" class="width-adjust font zoom" onclick="togglePopup();togglePopup1()">Add New Item</button>
                        </div>
                    </div>
                    <div class="columns group">
                        <div class="column is-12">
                            <button class="width-adjust fon zoom" name="runingLowItem">Running low Items</button>
                        </div>
                    </div>
            </form>
            <form action="" method="POST">
                <div class="columns group" <?php echo $style3 ?>>
                    <div class="column is-6 font adjust-margins artemis-input-field mt-1 ml-0">
                        <b><input class="artemis-input zoom text-align" type="text" placeholder="low than" name="lowThan">
                            <span class="label-wrap">
                                <span class="label-text">Low Than</span>
                            </span></b>
                    </div>
                    <div class="column is-6 ml-3" <?php echo $style4 ?>>
                        <button class="width-adjust font green-color zoom" name="go">GO</button>
                    </div>
                </div>
            </form>
            <div class="columns group">
                <div class="column is-12">
                    <button class="width-adjust font color-org zoom">Refresh</button>
                </div>
            </div>
            <div class="columns group">
                <div class="column is-12">
                    <button class="width-adjust font zoom" name="GRN-Report">GRN Report</button>
                </div>
            </div>
            <div class="columns group">
                <div class="column is-12">
                    <button class="width-adjust font zoom" name="Retrieve-Report">Retrieve Report</button>
                </div>
            </div>
            <div class="columns group">
                <div class="column is-12">
                    <button name="ratings" class="width-adjust font zoom">Ratings</button>
                </div>
            </div>
            <div class="columns group">
                <div class="column is-12">
                    <button name="saleReports" class="width-adjust font zoom">Sales Reports</button>
                </div>
            </div>
            <!-- <div class="columns group">
                        <div class="column is-12">
                            <button class="width-adjust font zoom" name="imageUploader">Image Uploader</button>
                        </div>
                    </div> -->
        </div>
    </div>
    </div>
    </div>

    <!---------XX-------inventory container-------XX--------->
    <script>
        function showDropDown() {
            document.getElementById("dropDown").style.display = "block";
            document.getElementById("btnup").style.display = "block";
        }

        function up() {
            document.getElementById("dropDown").style.display = "none";
            document.getElementById("btnup").style.display = "none";
            artemisAlert.alert('error', 'Enter a valid phone number!');
        }
    </script>
    <!------------pop up orders-------------->

    <section>
        <form action="" method="POST">
            <div <?php echo $style2 ?> class="popup-update" id="popup-1">
                <div class="popup-overlay-update" id="editOverlay"></div>
                <div class="pop-content-update">
                    <div class="columns group">
                        <div class="column is-12">
                            <h2 class="mt-0 mb-1"><span class="orange-color">Welcome to Eat</span>-<span>Me</span><span class="orange-color"> Inventory</span></h2>
                        </div>
                    </div>
                    <div class="columns group">
                        <div class="column is-12">
                            <h2><span class="orange-color">Item ID:</span> <?php echo ($newID); ?></h2>
                            <input type="hidden" value="<?php echo ($newID); ?>" name="id3">
                        </div>
                    </div>
                    <div class="columns group font">
                        <div class="column is-12 font artemis-input-field ">
                            <b><input class="artemis-input zoom text-align" type="text" placeholder="Item Name" name="itemName3" required>
                                <span class="label-wrap">
                                    <span class="label-text">Item Name</span>
                                </span></b>
                        </div>
                    </div>
                    <div class="columns group font">
                        <div class="column is-3 ">
                        </div>
                        <div class="column is-9 font artemis-input-field ">
                            <span> (Kg) <input type="radio" name="unitType" value="1" required></span>
                            <span> (l) <input type="radio" name="unitType" value="2" required></span>
                            <span> (items) <input type="radio" name="unitType" value="3" required></span>
                        </div>
                    </div>
                    <br>
                    <div class="columns group">
                        <div class="column is-4">
                        </div>
                        <div class="column is-4">
                            <button name="addItem" class="is-primary zoom"> Add New Item</button>
                        </div>
        </form>
        <div class="column is-4">
            <form acton="" method="POST">
                <button name="CloseAdd" class="is-primary btn-color-add zoom"> Close</button>
            </form>
        </div>
        </div>
        </div>
        </div>
    </section>


    <!------------ GRN-REPORT POP UP------------>
    <section>
        <form action="" method="POST">
            <div <?php echo $styleRepotPopOne ?> class="popup-update" id="popup-3">
                <div class="popup-overlay-update" id="editOverlay"></div>
                <div class="pop-content-update">
                    <div class="columns group">
                        <div class="column is-12">
                            <h2 class="mt-0 mb-1"><span class="orange-color"><?php echo $topic ?></span>-<span>REPORTS</span><span class="orange-color"> GENERATOR</span></h2>
                        </div>
                    </div>
                    <div class="columns group">
                        <div class="column is-6">
                            <h2 class="ml-1"> S_DATE</h2>
                        </div>
                        <div class="column is-6">
                            <input class="modify mt-2  ml-0" type="date" id="birthday" name="startDate" required>
                        </div>
                    </div>
                    <div class="columns group">
                        <div class="column is-6">
                            <h2 class="mt-0 mb-0 ml-1"> E_DATE</h2>
                        </div>
                        <div class="column is-6">
                            <input class="modify" type="date" id="birthday" name="endDate" required>
                        </div>
                    </div>
                    <div class="columns group">
                        <div class="column is-12" <?php echo  $styleGRNCreateRepoBtn;?>>
                            <button name="createGrnReport" class=" ml-0 is-primary  createReport-btn zoom"> Create GRN Report</button>
                        </div>
                        <div class="column is-12" <?php echo  $styleRetCreateRepoBtn;?>>
                            <button name="createRetrieveReport" class=" mr-1 is-primary  createReport-btn zoom"> Create Retrieve Report</button>
                        </div>
                </form>
                <form action="" method="POST">
                        <div class="column is-12">
                            <button  class="is-primary CloseReport-btn btn-color-add zoom"> Close</button>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        
    </section>

    <!------XX- GRN REPORT -----XX--->

    <script>
        function togglePopup1() {
            document.getElementById("popup-1").style.display = "block";
        }

        function closepopup01() {
            document.getElementById("popup-3").style.display = "none";
        }
    </script>
    <!---------xx---pop up orders-----xx--------->



    <!-- --------kitchen display js file -->
    <script type="text/javascript" src="../../js/kitchendisplay.js"></script>
</body>
<?php
  if (isset($_GET['attempt'])) {
    if ($_GET['attempt'] == 'false') {
      echo "<script> artemisAlert.alert('error', 'login failed')</script>";
    }
  }
  ?>

</html>