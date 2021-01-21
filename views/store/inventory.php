<?php
    session_start();
    ob_start();
    $staffid=$_SESSION['staffId'];
    $name_first=$_SESSION['firstName'];
    $name_last=$_SESSION['lastName'];
    require_once './controllers/store/InventoryController.php';
    $InventoryController = new InventoryController();

    if( isset( $_POST['logout'] ) ){
        $InventoryController->logoutstaffMem();
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
      if($staffid==1)
      {     
        ?>
         <section>
            <div class="row buttons-row">
                <a href="/admin">
                    <button class="button is-primary  right-radius idle">Dash Board</button>
                </a>
                <a href="/inventory">
                    <button class="button is-primary button-is-active  left-radius right-radius idle" >Inventory</button>

                </a>
                <a href="/grn">
                    <button class="button is-primary left-radius right-radius idle">GRN</button>
                </a>
                <a href="/admin/menu/update">
                    <button class="button is-primary left-radius right-radius idle">Menue</button>
                </a>
                <a href="/admin/staffmanage">
                    <button class="button is-primary  left-radius idle">Staff Manage</button>
                </a>
            </div>
        </section>
      <?php
      }
      else
      {
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
                        <table class="inventory-table">
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
                                    <td><?php echo $row['inventoryId']; ?></td>
                                    <td><?php echo $row['itemName']; ?></td>
                                    <td id="align-right"><?php echo $row['quantity']; ?></td>
                                    <td id="adjust-width"> <?php echo "(" . $InventoryController->getUnits($row['unitId']) . ")"; ?> </td>
                                    <td class="date-width">2020/11/03</td>
                                    <td class="date-width">2020/11/03</td>
                                    <td id="stuff"><button class="visibility-hide zoom" onclick="showDropDown()">update</button></td>
                                    <td id="stuff"><button class="visibility-hide zoom ">delete</button></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="column is-4">
            <div class="box-2">
                <div class="s-box-2 dropdown">
                    <h3>Last Updated Item 1155kL</h3>
                    <div class="dropdown-content" id="dropDown">
                        <div class="columns group">
                            <div class="column is-12 font">
                                <h2>Item 1155kL</h2>
                            </div>
                        </div>
                        <div class="columns group">
                            <div class="column is-6 font">
                                Id :
                            </div>
                            <div class="column is-6 font">
                                0256k
                            </div>
                        </div>
                        <div class="columns group">
                            <div class="column is-6 font">
                                Name :
                            </div>
                            <div class="column is-6 font">
                                hal-piti
                            </div>
                        </div>
                        <div class="columns group">
                            <div class="column is-6 font">
                                Quantity :
                            </div>
                            <div class="column is-6 font">
                                45.6(Kg)
                            </div>
                        </div>
                        <div class="columns group ">
                            <div class="column is-6 font">
                                Date :
                            </div>
                            <div class="column is-6 font">
                                2020/10/28
                            </div>
                        </div>
                        <div class="columns group">
                            <div class="column is-12">
                                <button class="width-adjust">Update</button>

                            </div>
                        </div>
                        <div class="columns group">
                            <div class="column is-12">
                                <button onclick="up()" id="btnup" class="width-adjust ml-2">Up</button>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <div class="box-2">
                <div class="s-box-2 adjust-height">
                    <div class="columns group">
                        <div class="column is-12">
                            QUICK ACCESS
                        </div>
                    </div>
                    <div class="columns group">
                        <div class="column is-12">
                            <button class="width-adjust font" onclick="togglePopup();togglePopup1()">Add New Item</button>
                        </div>
                    </div>
                    <div class="columns group">
                        <div class="column is-12">
                            <button class="width-adjust font">Sort by Date</button>
                        </div>
                    </div>
                    <div class="columns group">
                        <div class="column is-12">
                            <button class="width-adjust font">Running low Items</button>
                        </div>
                    </div>
                    <div class="columns group">
                        <div class="column is-12">
                            <button class="width-adjust font">Create Report</button>
                        </div>
                    </div>
                    <!-- <div class="columns group">
                        <div class="column is-12">
                            <button class="width-adjust font">-------</button>
                        </div>
                    </div>
                    <div class="columns group">
                        <div class="column is-12">
                            <button class="width-adjust font">-------</button>
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
    <div class="popup" id="popup-1">
        <div class="overlay"></div>
        <div class="pop-content">
            <div class="close-btn zoom" onclick="closepopup01()">&times;</div>
            <div class="column is-12 ml-0 mr-0">
                <div class="card">
                    <h2 class="orange-color mt-0 mb-1">Welcome 2 Eat-Me Inventory</h2>

                    <!------- add new item info  ----------->
                    <div class="columns group">
                        <div class="column is-12">
                            <h2>Item 1155kL</h2>
                        </div>
                    </div>
                    <div class="columns group font">
                        <div class="column is-6">
                            Id :
                        </div>
                        <div class="column is-6 font">
                            ____________________
                        </div>
                    </div>
                    <div class="columns group font">
                        <div class="column is-6">
                            Name :
                        </div>
                        <div class="column is-6 font">
                            ____________________
                        </div>
                    </div>
                    <div class="columns group font">
                        <div class="column is-6">
                            Quantity :
                        </div>
                        <div class="column is-6 font">
                            ____________________
                        </div>
                    </div>
                    <div class="columns group">
                        <div class="column is-12">
                            <button class="width-adjust">Add To Inventory</button>

                        </div>
                    </div>
                </div>
                <!----XX--- add new item info ------XX----->
            </div>
        </div>

    </div>
    </div>
    <script>
        function togglePopup1() {
            document.getElementById("popup-1").style.display = "block";
        }

        function closepopup01() {
            document.getElementById("popup-1").style.display = "none";
        }
    </script>
    <!---------xx---pop up orders-----xx--------->


    <!-- --------kitchen display js file -->
    <script type="text/javascript" src="../../js/kitchendisplay.js"></script>
</body>

</html>