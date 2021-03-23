<?php
    session_start();
    ob_start();
    $staffid=$_SESSION['staffId'];
    $name_first=$_SESSION['firstName'];
    $name_last=$_SESSION['lastName'];

    require_once './controllers/store/KitchenMenuUpdateController.php';
    $KitchenMenuUpdateController = new KitchenMenuUpdateController();

    if( isset( $_POST['logout'] ) ){
        $KitchenMenuUpdateController->logoutstaffMem();
      }

    function ext($i_id) 
    {
        $itemID=$i_id;
        return $itemID;
    }
    if(isset($_POST['updateToHide'])) {
        $ans=ext($_REQUEST['updateToHide']);
        $KitchenMenuUpdateController->updateAvailabilityHide($ans);
    }
    if(isset($_POST['updateToShow'])) {
        $ans=ext($_REQUEST['updateToShow']);
        $KitchenMenuUpdateController->updateAvailabilityShow($ans);
    }
    if(isset($_POST['hideAllItems'])) {
        $KitchenMenuUpdateController->hideAllItems();
    }
    if(isset($_POST['showAllItems'])) {
        $KitchenMenuUpdateController->showAllItems();
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
            <span class="mr-1"><?php echo $staffid?></span>
            <span class="mr-1"><?php echo $name_first," ",$name_last?></span>
            <button class="button is-primary" name="logout">Logout</button>
            </div>
        </div>
        </div>
    </form>
    <!--------xx-----navi bar --------xx------->
    <!----------- navigatable buttons------------>
    <?php
      if(isset($staffid))
      {
        
        ?>
        <section>
        <div class="row buttons-row">
            <a href="/kitchendisplay/orders">
                <button class="button is-primary right-radius">Orders</button>

            </a>
            <a href="/kitchendisplay/inventory">
                <button class="button is-primary left-radius right-radius idle">Items</button>
            </a>
            <a href="/kitchen/menu/update">
                <button class="button is-primary  button-is-active  left-radius idle">Menu</button>
            </a>
        </div>
        </section>

      <?php
      }
      else
      {
        $KitchenMenuUpdateController->logoutstaffMem();
      }
    ?>
<!-----XX------ navigatable buttons-----XX------->

<!----------- Main Section----------->

    <section>
        <div class="content">
            <div class="columns group">
                <div class="column is-3">
                    <h2>Men<span class="change-menu-color">ue</span></h2>

                    <?php $KitchenMenuUpdateController->renderMainMenu(); 
                          $KitchenMenuUpdateController->renderMainMenuHide(); ?>

                </div>
                <div class="column is-3">
                    <h2>Star<span class="change-menu-color">ters</span></h2>

                    <?php $KitchenMenuUpdateController->renderStarters();
                          $KitchenMenuUpdateController->renderStartersHide(); ?>

                </div>
                <div class="column is-3">
                    <h2>Beve<span class="change-menu-color">rages</span></h2>

                    <?php $KitchenMenuUpdateController->renderBeverages(); 
                          $KitchenMenuUpdateController->renderBeveragesHide(); ?>

                </div>
                <div class="column is-3">
                    <h2>Desse<span class="change-menu-color">rts</span></h2>

                    <?php $KitchenMenuUpdateController->renderDesserts(); 
                          $KitchenMenuUpdateController->renderDessertsHide(); ?>

                </div>
            </div>
       
            <div class="columns group">
                <form action="" method="POST">
                    <div class="column is-12">
                        <button class="hide-all-items-btn" name="hideAllItems">Hide all items</button>
                    </div>
                </form>
            </div>
            <div class="columns group">
                <form action="" method="POST">
                    <div class="column is-12">
                        <button class="hide-all-items-btn show-all-items-btn" name="showAllItems">Show all items</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
<!------XX----- Main Section-----XX------>
    <script>
        function hideOpen(id) {
            document.getElementById(id).style.visibility = "visible";
        }

        function hideClose(id) {
            document.getElementById(id).style.visibility = "hidden";
        }
    </script>
</body>

</html>