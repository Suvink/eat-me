<?php
session_start();
ob_start();
$staffid = $_SESSION['staffId'];
$name_first = $_SESSION['firstName'];
$name_last = $_SESSION['lastName'];
$roleId = $_SESSION['roleId'];
require_once './controllers/admin/MenuUpdateController.php';
$MenuUpdateController = new MenuUpdateController();

$style = "style=display:none";

$newID=null;
if (isset($_POST['addNewItem'])) {
    $style = "style=display:display";
    $newID=$MenuUpdateController->takeNewID(); 
}
if (isset($_POST['addItem'])) {

    $itemNumber = $_POST['itemNumberAdd'];
    $itemName = $_POST['itemNameAdd'];
    $itemPrice = $_POST['itemPriceAdd'];
    $itemType = $_POST['itemTypeAdd'];
    //echo $itemName, $itemPrice, $itemType, $itemNumber;
    $MenuUpdateController->AddMenuItem($itemNumber, $itemName, $itemPrice, $itemType);
}
if (isset($_POST['logout'])) {
    $MenuUpdateController->logoutstaffMem();
}

function ext($i_id)
{
    $itemID = $i_id;
    return $itemID;
}
if (isset($_POST['updateToHide'])) {
    $ans = ext($_REQUEST['updateToHide']);
    $MenuUpdateController->updateAvailabilityHide($ans);
}
if (isset($_POST['updateToShow'])) {
    $ans = ext($_REQUEST['updateToShow']);
    $MenuUpdateController->updateAvailabilityShow($ans);
}

if (isset($_POST['updateToUpdate'])) {
    $ans = ext($_REQUEST['updateToUpdate']);
    $MenuUpdateController->updateAvailabilityUpdate($ans);
}
if (isset($_POST['hideAllItems'])) {
    $MenuUpdateController->hideAllItems();
}
if (isset($_POST['showAllItems'])) {
    $MenuUpdateController->showAllItems();
}
if (isset($_POST['updateMenu'])) {
    $ans = ext($_REQUEST['updateMenu']);
    $itemName = $_POST['itemName'];
    $itemPrice = $_POST['itemPrice'];
    $itemType = $_POST['itemType'];
    $MenuUpdateController->updateMenu($ans, $itemName, $itemPrice, $itemType);
}
if (isset($_POST['showMenu'])) {
    $ans = ext($_REQUEST['showMenu']);
    $MenuUpdateController->updateAvailabilityShow($ans);
}
if (isset($_POST['deleteMenu'])) {
    $ans = ext($_REQUEST['deleteMenu']);
    $MenuUpdateController->deleteMenu($ans);
}
if (isset($_POST['hideMenu'])) {
    $ans = ext($_REQUEST['hideMenu']);
    $MenuUpdateController->updateAvailabilityHide($ans);
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
    <link rel="stylesheet" href="../../css/adminMenuUpdate.css">
    <link rel="stylesheet" href="../../css/kitchenMenuUpdate.css">
    <title>kitchen Menu</title>
    <!-- <script type="text/javascript" src="../../js/kitchendisplay.js"></script> -->

</head>

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
                    <button class="button is-primary left-radius right-radius idle">Inventory</button>

                </a>
                <a href="/grn">
                    <button class="button is-primary left-radius right-radius idle">GRN</button>
                </a>
                <a href="/admin/menu/update">
                    <button class="button is-primary button-is-active  left-radius right-radius idle">Menu</button>
                </a>
                <a href="/admin/staffmanage">
                    <button class="button is-primary left-radius idle">Staff Manage</button>
                </a>
            </div>
        </section>
    <?php
    } else {
        $MenuUpdateController->logoutstaffMem();
    }
    ?>
    <!-----XX------ navigatable buttons-----XX------->
    <section>
    <div class="content-admin adjust-place-two">
                <div class="columns group">
                    <form action="" method="POST">
                        <div class="column is-4">
                            <button class="hide-all-items-btn-two add-new-items-btn zoom" name="addNewItem">Add New Item</button>
                        </div>
                    </form>
                <!-- </div>
                <div class="columns group"> -->
                    <form action="" method="POST">
                        <div class="column is-4">
                            <button class="hide-all-items-btn-two zoom" name="hideAllItems">Hide all items</button>
                        </div>
                    </form>
                <!-- </div>
                <div class="columns group"> -->
                    <form action="" method="POST">
                        <div class="column is-4">
                            <button class="hide-all-items-btn-two show-all-items-btn zoom" name="showAllItems">Show all items</button>
                        </div>
                    </form>
                </div>
            </div>
    </section>
    <section>
        <div class="columns group">
            <div class="content-admin">
                <div class="column is-3">
                    <h2>Men<span class="change-menu-color">ue</span></h2>

                    <?php $MenuUpdateController->renderMainMenu();
                    $MenuUpdateController->renderMainMenuHide();
                    $MenuUpdateController->renderMainMenuUpdate(); ?>

                </div>
                <div class="column is-3">
                    <h2>Star<span class="change-menu-color">ters</span></h2>

                    <?php $MenuUpdateController->renderStarters();
                    $MenuUpdateController->renderStartersHide();
                    $MenuUpdateController->renderStartersUpdate(); ?>

                </div>
                <div class="column is-3">
                    <h2>Beve<span class="change-menu-color">rages</span></h2>

                    <?php $MenuUpdateController->renderBeverages();
                    $MenuUpdateController->renderBeveragesHide();
                    $MenuUpdateController->renderBeveragesUpdate(); ?>

                </div>
                <div class="column is-3">
                    <h2>Desse<span class="change-menu-color">rts</span></h2>

                    <?php $MenuUpdateController->renderDesserts();
                    $MenuUpdateController->renderDessertsHide();
                    $MenuUpdateController->renderDessertsUpdate(); ?>

                </div>
            </div>
        </div>
    </section>
    <!-- ________add new item __________________ -->
    <section>
    <form action="" method="POST">
        <div <?php echo $style ?> class="popup-update" id="popup-1">
            <div class="popup-overlay-update" id="editOverlay"></div>
                <div class="pop-content-update">
                    <!-- <div class="close-btn-update zoom" onclick="closepopup01()">&times;</div> -->
                    <div class="columns group">
                        <div class="column is-4">
                            <h2>Item Number :</h2>
                        </div>
                        <div class="column is-8 field artemis-input-field arrange-position">
                            <input class="artemis-input zoom font-color font-size" type="text" placeholder="Item Number" name="itemNumberAdd"  value ="<?php echo $newID;?>" required>
                            <span class="label-wrap">
                                <span class="label-text">Item Number</span>
                            </span>
                        </div>
                    </div>
                    <div class="columns group font">
                        <div class="column is-4 arrange-position font-color">
                            Item Name:
                        </div>
                        <div class="column is-8 field artemis-input-field arrange-position">
                            <input class="artemis-input zoom" type="text" placeholder="Item Name" name="itemNameAdd" required>
                            <span class="label-wrap">
                                <span class="label-text">Item Name</span>
                            </span>
                        </div>
                    </div>
                    <div class="columns group font">
                        <div class="column is-4 arrange-position font-color">
                            Price (q1)Rs :
                        </div>
                        <div class="column is-8 field artemis-input-field arrange-position">
                            <input class="artemis-input zoom" type="text" placeholder="Item Price" name="itemPriceAdd"  required>
                            <span class="label-wrap">
                                <span class="label-text">Item Price</span>
                            </span>
                        </div>
                    </div>
                    <div class="columns group font">
                        <div class="column is-12 ">
                            ________________ <span class="font-color">Adding a New Item</span> ____________________
                        </div>
                    </div>
                    <div class="columns group font">
                        <div class="column is-2 arrange-position font-color mr-0  mt-1">
                            Type:
                        </div>
                        <div class="column is-10 ml-0 mt-1 field  arrange-position">
                            <span> Mains<input type="radio" name="itemTypeAdd" value="mains"  required></span>
                            <span class="ml-1"> Starters<input type="radio"  name="itemTypeAdd" value="starters"  required></span>
                            <span class="ml-1">Beverages<input type="radio"  name="itemTypeAdd" value="beverages" required></span>
                            <span>Desserts<input type="radio"  name="itemTypeAdd" value="desserts"  required></span>
                        </div>
                    </div>
                    <div class="columns group">
                        <div class="column is-5">
                        </div>
                        <div class="column is-3">
                            <button name="addItem"class="is-primary zoom"> Add New Item</button>
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
    <!-- ________add new item __________________ -->
    <script>
        function hideOpen(id) {
            document.getElementById(id).style.visibility = "visible";
            document.getElementById('btnUpdate-' + id).style.visibility = "visible";
        }

        function hideClose(id) {
            document.getElementById(id).style.visibility = "hidden";
            document.getElementById('btnUpdate-' + id).style.visibility = "hidden";
        }

        function hideUpdatebtn(id) {
            // 
            document.getElementById('btnUpdate-' + id).style.visibility = "hidden";

        }

        function togglePopup1() {
            document.getElementById('editOverlay').style.display = "block";
            document.getElementById("popup-1").classList.toggle("active");
        }

        function closepopup01() {
            document.getElementById("popup-1").style.display = "none";
        }
    </script>

    <!-- --------kitchen display js file -->
    <script type="text/javascript" src="../../js/kitchendisplay.js"></script>
</body>

</html>