<?php require_once './controllers/store/GrnController.php';
$GrnController = new GrnController();
$result4 = null;
$output = null;
$style = ""; //to hide the up btn 
if (isset($_POST['search'])) {
    $searchq = $_POST['search'];
    if ($searchq == null) {
        $output = $GrnController->sendSearhQuery($searchq);
    } else {

        $result4 = $GrnController->sendSearhQuery($searchq);
    }
    $style = "style='display:block;'";
}

?>

<?php

if (isset($_POST['sendbtn'])) {
    $newq = $_POST['newq'];
    $oldq = $_POST['oldq'];
    $unitId = $_POST['unitId'];
    $itemId = $_POST['itemId'];
    echo $GrnController->getInputVal($newq, $oldq, $unitId, $itemId);
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
    <link rel="stylesheet" href="../../css/kitchenInventory.css">
    <link rel="stylesheet" href="../../css/inventory.css">
    <title>kitchen Display</title>
    <!-- <script type="text/javascript" src="../../js/kitchendisplay.js"></script> -->

</head>

<body onload="hideUpbtn()">

    <!-- -----navi bar ---------- -->
    <div class="navbar">
        <div class="columns group">
            <div class="column is-2">
                <img src="../../img/logo.png" height=56 width="224" />
            </div>
            <div class="column is-6 ml-5"></div>
            <div class="column is-3 has-text-right nav-logout">
                <i class="fa fa-user" aria-hidden="true"></i>
                <span class="mr-1">ADMIN</span>
                <button class="button is-primary">Logout</button>
            </div>
        </div>
    </div>
    <!--------xx-----navi bar --------xx------->




    <!----------- Main section------------>
    <section>
        <div class="row buttons-row">
            <a href="/inventory">
                <button class="button is-primary right-radius">Inventory</button>

            </a>
            <a href="/grn">
                <button class="button is-primary button-is-active left-radius idle">GRN</button>
            </a>
        </div>
    </section>

    <section>
        <div class="column is-12">
            <section>
                <h2><span id="grnpage-header">Eat-Me </span>Grn <span id="grnpage-header">Page</span></h2>
                <div class="search-boxs ">
                    <div class="search-box ">

                        <form method="POST" action="">
                            <div class="holder ">
                                <div class="columns group">
                                    <div class="column is-11">
                                        <input type="text" class="search-feild" placeholder="" name="search" value="" />
                                        <button class=" search-button fa fa-search zoom"></button>
                                    </div>
                                    <div class="column is-1">

                                    </div>
                                </div>
                                <div class="columns group">
                                    <div class="column is-12" id="output">
                                        <?php echo $output ?>
                                    </div>
                                </div>

                            </div>

                        </form>
                        <div class="menu-cards" id="hide">
                            <?php

                            if ($result4 != null) {
                                while ($row = mysqli_fetch_assoc($result4)) {
                            ?>
                                    <form method="POST" action="/grn">
                                        <div class="container">
                                            <div class="menu-card">
                                                <img src="https://image.flaticon.com/icons/svg/1775/1775636.svg">
                                                <div class="columns group">
                                                    <div class="column is-6">
                                                        <h3 class="mt-1 mb-0">Item_ID :</h3>
                                                    </div>
                                                    <div class="column is-6">
                                                        <input type="hidden" name="itemId" value="<?php echo $row['inventoryId']; ?>">
                                                        <h3 class="mt-1 mb-0"><?php echo $row['inventoryId']; ?></h3>
                                                    </div>
                                                    <div class="column is-12">
                                                        <h3 class="mt-1 mb-0"><?php echo $row['itemName'] ?></h3>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="menu-card retrieve-box mt-2 ml-2 card-zoom">
                                                <div class="columns group">
                                                    <div class="column is-7">
                                                        <h3 class="mt-1 mb-0 ml-0">Current Quantity:</h3>
                                                    </div>
                                                    <div class="column is-5">
                                                        <input type="hidden" name="oldq" value="<?php echo $row['quantity']; ?>">
                                                        <input type="hidden" name="unitId" value="<?php echo $row['unitId']; ?>">
                                                        <h3 class="mt-1 mb-0"><?php
                                                                                echo $GrnController->getRoundOfVal($row['unitId'], $row['quantity']);
                                                                                echo "(" . $GrnController->getMeasurementUnit($row['unitId']) . ")";
                                                                                ?>
                                                        </h3>
                                                    </div>
                                                </div>
                                                <div class="columns group">
                                                    <div class="column is-12">
                                                        <h3 class="mt-1 mb-0 f-size"><input type="text" name="newq" class="retreive-quantity-txtbox"><?php echo "(" . $GrnController->getMeasurementUnit($row['unitId']) . ")" ?></h3>
                                                    </div>
                                                </div>
                                                <div class="columns group">
                                                    <div class="column is-12">
                                                        <h3 class="mt-1 mb-0"><button name="sendbtn" class="add-stock-quantity-addbtn">Add to Stock</button></h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                            <?php
                                }
                            }
                            ?>

                        </div>
                        <div class="columns group">
                            <div class="column is-12 ">
                                <button onclick="hideSearchBox();hidebtn()" id="btnhide" class="blinking hide-up" <?php echo $style; ?>>up</button>
                            </div>
                        </div>
                    </div>

                </div>
            </section>
        </div>
        </div>

    </section>
    <!----xx------- Main section----xx-------->



    <!-- --------kitchen display js file -->
    <script type="text/javascript" src="../../js/kitchenretrieve.js"></script>
</body>

</html>