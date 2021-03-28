<?php
session_start();
ob_start();
$staffid = $_SESSION['staffId'];
$name_first = $_SESSION['firstName'];
$name_last = $_SESSION['lastName'];
$roleId = $_SESSION['roleId'];
require_once("./controllers/store/KitchenDisplayOrdersController.php");
$KitchenDisplayOrdersController = new KitchenDisplayOrdersController();

if (isset($_POST['logout'])) {
  $KitchenDisplayOrdersController->logoutstaffMem();
}
function ext($i_id)
{
  $itemID = $i_id;
  return $itemID;
}
$style = "style=display:none";
$style7="style=display:none";
$id = null;
$getOrderItems = null;
if (isset($_POST['click'])) {
  $style = "style=display:display";
  $ans = ext($_REQUEST['click']);
  $id = $ans;
  $orderStatusBtn = $KitchenDisplayOrdersController->getOrderStatusBtn($ans);
  $row = mysqli_fetch_assoc($orderStatusBtn);
  if ($row['orderStatus'] == "2") {
    $style2 = "style=display:none";
    $style3 = "style=display:block";
  } else if ($row['orderStatus'] == "4") {
    $style2 = "style=display:none";
    $style3 = "style=display:none";
    $style7 = "style=display:block";
  } else if ($row['orderStatus'] == "5") {
    $style2 = "style=display:none";
    $style3 = "style=display:none";
    $style6 = "style=display:none";
    $style7 = "style=display:none";
  } else {
    $style2 = "style=display:display";
  }
  $getOrderItems = $KitchenDisplayOrdersController->getOrderItems($ans);
}
if (isset($_POST['accept-btn'])) {
  $orId = $_POST['orId'];
  $KitchenDisplayOrdersController->updateToAccept($orId);
}
if (isset($_POST['decline-btn'])) {
  $orId = $_POST['orId'];
  $KitchenDisplayOrdersController->updateToDecline($orId);
  // need to romve the orer from the list
}
$style4 = "style=display:none";
$getRiders = null;
if (isset($_POST['riders'])) {
  $style4 = "style=display:display";
  $style = "style=display:display";
  $style2 = "style=display:none";
  $style3 = "style=display:block";
  $orId = $_POST['orId'];
  $id = $orId;
  $getOrderItems = $KitchenDisplayOrdersController->getOrderItems($orId);
  $getRiders = $KitchenDisplayOrdersController->getRiders();
}
$style5 = "style=display:none";
if (isset($_POST['click-2'])) {
  $ans = ext($_REQUEST['click-2']);
  $sid = $ans;
  $ordeId=$_POST['ordeId'];
  // echo $ordeId." ".$sid;
  $style5 = "style=display:display";
  $style4 = "style=display:display";
  $style = "style=display:display";
  $style2 = "style=display:none";
  $style3 = "style=display:block";
  $id = $ordeId;
  $getOrderItems = $KitchenDisplayOrdersController->getOrderItems($ordeId);
  $getRiders = $KitchenDisplayOrdersController->getRiders();
}
$style6= "style=display:none";
if (isset($_POST['asignesOrders'])) {
  $assOrId= $_POST['assOrId'];
  $dateAndTime= $_POST['dateAndTime'];
  $fName= $_POST['fName'];
  $assSId= $_POST['assSId'];
  // echo $assOrId,$dateAndTime,$fName,$assSId;
  $KitchenDisplayOrdersController->orderAssign($assOrId,$assSId, $dateAndTime,$fName);
  $style = "style=display:display";
  $style2 = "style=display:none";
  $style3 = "style=display:none";
  $id = $assOrId;
  $getOrderItems = $KitchenDisplayOrdersController->getOrderItems($assOrId);
  $style6 = "style=display:block";
  $KitchenDisplayOrdersController->updateToAssigned($assOrId,$dateAndTime);
  $KitchenDisplayOrdersController->updateRiderStatus($assSId);
}
// $style8 = "style=display:none";
if (isset($_POST['prepared1'])) {
  $orId = $_POST['orId'];
  $KitchenDisplayOrdersController->updateToPrepared($orId);
  $style6= "style=display:none";
  // $style8 = "style=display:display";
}
if (isset($_POST['prepared2'])) {
  $orId = $_POST['orId'];
  $KitchenDisplayOrdersController->updateToprepared($orId);
  $style6= "style=display:none";
  // $style8 = "style=display:display";
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" type="image/png" href="../../img/favicon.png" />
  <!-- Global Styles -->
  <link rel="stylesheet" href="../../css/style.css" />
  <!-- Local Styles -->
  <link rel="stylesheet" href="../../css/adminMenuUpdate.css">
  <link rel="stylesheet" href="../../css/kitchenMenuUpdate.css">
  <link rel="stylesheet" href="../../css/kitchendisplay.css">
  <title>kitchen Display</title>
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
  if ($roleId == "2") {

  ?>
    <section>
      <div class="row buttons-row">
        <a href="/kitchendisplay/orders">
          <button class="button is-primary button-is-active right-radius">Orders</button>

        </a>
        <a href="/kitchendisplay/inventory">
          <button class="button is-primary left-radius right-radius idle">Items</button>
        </a>
        <a href="/kitchen/menu/update">
          <button class="button is-primary left-radius idle">Menu</button>
        </a>
      </div>
    </section>
  <?php
  } else {
    $KitchenDisplayOrdersController->logoutstaffMem();
  }
  ?>
  <!-----XX------ navigatable buttons-----XX------->

  <!----------- Main Section ------------>
  <section>
    <div class="column is-12">
      <div class="tabs">
        <input type="radio" id="tab1" name="tab-control" checked>
        <input type="radio" id="tab2" name="tab-control">
        <ul>
          <li title="O_Orders"><label for="tab1" role="button"><br><span>O_Oders</span></label></li>
          <li title="D_Orders"><label for="tab2" role="button"><br><a href="/kitchendisplay/dinein/orders"><span>D_Oders</a></span></label></li>
        </ul>

        <div class="slider">
          <div class="indicator"></div>
        </div>
        <div class="content-1">
          <section>
            <h2>O_Orders</h2>
            <div class="menu-cards">
              <?php
              $result = $KitchenDisplayOrdersController->getOrderDetails();
              while ($row = mysqli_fetch_assoc($result)) {
              ?>
                <form class="click-btn" action="" method="POST">
                  <div class="menu-card card-zoom" onclick="togglePopup();togglePopup1()" name="menu-card-details">
                    <button name="click" class="click-btn" id="online-order-id-btn" value="<?php echo $row['orderId'] ?>">
                      <img src="https://image.flaticon.com/icons/svg/1775/1775636.svg">
                    </button>
                    <div class="columns group">
                      <div class="column is-6">
                        <h3 class="mt-1 mb-0">Order ID:</h3>
                      </div>
                      <div class="column is-6">
                        <h3 class="mt-1 mb-0" id="card-orderId" name="orderId"><?php echo $row['orderId'] ?></h3>
                      </div>
                    </div>
                    <?php
                    if ($row['orderStatus'] == "2") {
                    ?>
                      <div class="columns group ">
                        <div class="column is-12">
                          <h3 class="mt-1 mb-0 color-accept">Accepted</h3>
                        </div>
                      </div>
                    <?php
                    } else if ($row['orderStatus'] == "4") {
                    ?>
                      <div class="columns group ">
                        <div class="column is-12">
                          <h3 class="mt-1 mb-0 color-accept">Accepted</h3>
                        </div>
                      </div>
                      <div class="columns group">
                        <div class="column is-12">
                          <h3 class="mt-1 mb-0 color-assign">Assigned</h3>
                        </div>
                      </div>
                    <?php
                    } else if ($row['orderStatus'] == "5") {
                    ?>
                      <div class="columns group">
                        <div class="column is-12">
                          <h3 class="mt-1 mb-0 color-accept">Accepted</h3>
                        </div>
                      </div>
                      <div class="columns group">
                        <div class="column is-12">
                          <h3 class="mt-1 mb-0 color-assign">Assigned</h3>
                        </div>
                      </div>
                      <div class="columns group">
                        <div class="column is-12">
                          <h3 class="mt-1 mb-0 color-prepare">Prepared</h3>
                        </div>
                      </div>
                    <?php
                    }
                    ?>
                  </div>
                </form>
              <?php
              }
              ?>
            </div>

          </section>
          <section>
            <h2>D_Orders</h2>
          </section>

        </div>
      </div>
    </div>

  </section>
  <!----xx------- Main section----xx-------->

  <!------------pop up orders-------------->
  <section>
    <form action="" method="POST">
      <div <?php echo $style ?> class="popup-update" id="popup-1">
        <div class="popup-overlay-update" id="editOverlay"></div>
        <div class="pop-content-update placement-top">
          <div class="close-btn-update zoom" onclick="closepopup01()">&times;</div>
          <div class="card">
            <h2 class="orange-color mt-0 mb-1">Order <?php echo $id; ?> </h2>
            <input type="hidden" value="<?php echo $id; ?>" name="orId">
            <?php
            if ($getOrderItems != null) {
              while ($row2 = mysqli_fetch_assoc($getOrderItems)) {
            ?>

                <!------- show ordered list ----------->
                <div class="order-selected-item">
                  <div class="order-selected-row">
                    <div class="order-selected-row-image">
                      <img src="https://image.flaticon.com/icons/svg/184/184410.svg">
                    </div>
                    <div class="order-selected-row-description has-text-left">
                      <h4 class="mb-0 mt-0">
                        <?php
                        $result3 = $KitchenDisplayOrdersController->getItemName($row2['itemNo']);
                        $row3 = mysqli_fetch_assoc($result3);
                        echo $row3['itemName'];

                        ?>
                      </h4>
                    </div>
                    <div class="order-selected-row-quantity">
                      <h4 class="mb-0 mt-0">quan : <?php echo $row2['qty'] ?></h4>
                    </div>
                  </div>
                </div>
            <?php
              }
            }
            ?>
          </div>
          <div class="total-box d-flex">
            <div class="title-col">
              <h3 class="mt-1 mb-1">Total Amount</h3>
              <h3 class="mt-1 mb-1">Order Location</h3>
              <h3 class="mt-1 mb-1">Arived Time</h3>
              <h3 class="mt-1 mb-1" >Assigned Time</h3>
              <h3 class="mt-1 mb-1" >Prepared Time</h3>
            </div>
            <div class="price-col has-text-right mr-1">
              <h3 class="mt-1 mb-1">
                <?php
                $result4 = $KitchenDisplayOrdersController->getTotal($id);
                $row4 = mysqli_fetch_assoc($result4);
                echo "Rs " . $row4['amount'];

                ?>
              </h3>
              <h3 class="mt-1 mb-1">
                <?php
                $result6 = $KitchenDisplayOrdersController->getAddress($id);
                $row6 = mysqli_fetch_assoc($result6);
                echo $row6['address'];

                ?>
              </h3>
              <h3 class="mt-1 mb-1">
                <?php
                $result5 = $KitchenDisplayOrdersController->getDateAndTime($id);
                $row5 = mysqli_fetch_assoc($result5);
                $arrivedTime= $row5['timestamp'];
                date_default_timezone_set("Asia/Colombo");
                echo date('Y/m/d H:i:s',  $arrivedTime);

                ?>
              </h3>
              <h3 class="mt-1 mb-1" >
                <?php
                $result5 = $KitchenDisplayOrdersController->getAssignedDateAndTime($id);
                $row5 = mysqli_fetch_assoc($result5);
                if( $row5['assignedTime'] != null)
                {
                  $assignedTime= $row5['assignedTime'];
                  date_default_timezone_set("Asia/Colombo");
                  echo date('Y/m/d H:i:s',   $assignedTime);
                }
                ?>
              </h3>
              <h3 class="mt-1 mb-1">
                <?php
                $result5 = $KitchenDisplayOrdersController->getPreparedDateAndTime($id);
                $row5 = mysqli_fetch_assoc($result5);
                if( $row5['preparedTime'] != null)
                {
                  $preparedTime= $row5['preparedTime'];
                  date_default_timezone_set("Asia/Colombo");
                  echo date('Y/m/d H:i:s',  $preparedTime);
  
                }
                ?>
              </h3>
            </div>
          </div>
          <div class="columns group font">
            <div class="column is-6" id="btnAccept" <?php echo $style2 ?>>
              <button class="button is-primary mt-1 zoom  resizebtn" onclick="hideAcceptDecline()" name="accept-btn">Accept</button>
            </div>
            <div class="column is-6" id="btnDecline" <?php echo $style2 ?>>
              <button class="button is-danger mt-1 zoom resizebtn" onclick="return confirm('Are you sure you want to decline this order?');" id="switch-decline-orders" name="decline-btn">Decline</button>
            </div>
          </div>
          <div class="columns group font">
            <div class="column is-12" id="btnRiders" <?php echo $style3 ?>>
              <button class="button is-link mt-1 zoom mr-1 resizebtn" name="riders">Riders</button>
            </div>
            <div class="column is-12" id="btnPrepared"  <?php echo $style6 ?> >
              <button class="button is-success mt-1 mr-1 zoom resizebtn" name="prepared1">Prepared</button>
            </div>
            <div class="column is-12" id="btnPrepared"   <?php echo $style7 ?>>
              <button class="button is-success mt-1 mr-1 zoom resizebtn" name="prepared2">Prepared</button>
            </div>
          </div>
        </div>
      </div>
      </div>
    </form>
  </section>
  <script>
    function closepopup01() {
      document.getElementById("popup-1").style.display = "none";
      document.getElementById("popup-2").style.display = "none";
      document.getElementById("popup-3").style.display = "none";
    }

    function closepopup02() {
      document.getElementById("popup-2").style.display = "none";
    }
    function closepopup03() {
      document.getElementById("popup-3").style.display = "none";
    }
  </script>
  <!---------xx---pop up orders-----xx--------->

  <!----------pop up delivery people ----------------->
  <section>
    <div <?php echo $style4 ?> class="popup-update" id="popup-2">
      <div class="pop-content-update-riders">
        <!-- <div class="card"> -->
        <div class="close-btn-update-riders zoom" onclick="closepopup02()">&times;</div>
        <?php
        if ($getRiders != null) {
          while ($row6 = mysqli_fetch_assoc($getRiders)) {
        ?>
            <form action="" method="POST">
              <div class="menu-cards mt-2 ">
                <div class="dp-card" >
                  <div class="columns group">
                    <div class="column is-6">
                      <h3 class="mt-1 mb-0">Rieder <?php echo $row6['staffId']; ?></h3>
                    </div>
                    <div class="column is-6">
                      <h3 class="mt-1 mb-0 rider-status">
                        <?php
                        $result7 = $KitchenDisplayOrdersController->getRiderStatus($row6['staffId']);
                        $row7 = mysqli_fetch_assoc($result7);
                        // echo $id;
                        if($row7['status']=="available")
                        {
                          ?>
                            <button name="click-2" value="<?php echo $row6['staffId']; ?>"  class="availibity-btn mb-2"><?php echo $row7['status'];?></button>
                            <input type="hidden" name="ordeId" value="<?php echo $id; ?>">
                          <?php
                        }
                        else
                        {
                          ?>
                            <?php echo $row7['status'];?>
                          <?php
                        }
                        ?>
                      </h3>
                    </div>
                  </div>
                </div>
              </div>
            </form>
        <?php
          }
        }
        ?>
        <!-- </div> -->
      </div>
    </div>
    </div>


  </section>
  <!------XX----pop up delivery people -------XX---------->

  <!----------pop up 03/ summery ----------------->
  <form action="" method="POST">
  <div class="popup" id="popup-3" <?php echo $style5 ?>>
    <div class="pop-content3">
    <div class="close-btn-update-riders zoom" onclick="closepopup03()">&times;</div>

      <h2 class="orange-color mt-0 mb-1 ">Order Asign Summery</h2>
      <div class="menu-cards">
        <div class="asiggned-summery-card">
          <div class="columns group">
            <div class="column is-6">
              <h3 class="mt-1 mb-2">Order Id</h3>
            </div>
            <div class="column is-6">
              <h3 class="mt-1 mb-2 rider-status"><?php echo $ordeId;?></h3>
              <input type="hidden" value="<?php echo $ordeId;?>" name="assOrId" >
            </div>
          </div>
          <div class="columns group">
            <div class="column is-6">
              <h3 class="mt-1 mb-2">Assigned Time</h3>
            </div>
            <div class="column is-6">
              <h3 class="mt-1 mb-2 rider-status"> <?php date_default_timezone_set("Asia/Colombo");
                                                    $datetime = date("Y-m-d,h:i");
                                                    echo $datetime;?></h3>
                                                    <input type="hidden" value="<?php echo $datetime;?>" name="dateAndTime" >
            </div>
          </div>
          <div class="columns group">
            <div class="column is-6">
              <h3 class="mt-1 mb-2">Location</h3>
            </div>
            <div class="column is-6">
            <h3 class="mt-1 mb-2 rider-status">
                                                  <?php
                                                    $result6 = $KitchenDisplayOrdersController->getAddress($ordeId);
                                                    $row6 = mysqli_fetch_assoc($result6);
                                                    echo $row6['address'];

                                                    ?>
                                                  </h3>
            </div>
          </div>
          <div class="columns group">
            <div class="column is-6">
            <h3 class="mt-1 mb-2">Rider ID</h3>
            </div>
            <div class="column is-6">
              <h3 class="mt-1 mb-2 rider-status"><?php echo $sid;?></h3>
              <input type="hidden" value="<?php echo $sid;?>" name="assSId" >
            </div>
          </div>
          <div class="columns group">
            <div class="column is-6">
              <h3 class="mt-1 mb-2">Name</h3>
            </div>
            <div class="column is-6">
              <h3 class="mt-1 mb-2 rider-status"> <?php
                                                    $result8 = $KitchenDisplayOrdersController->riderName($sid);
                                                    $row8 = mysqli_fetch_assoc($result8);
                                                    echo $row8['firstName'];
                                                      ?>
                                                        <input type="hidden" value="<?php echo $row8['firstName'];?>" name="fName" >
                                                      <?php
                                                    ?>
                                                  </h3>
            </div>
          </div>
          <div class="columns group">
            <div class="column is-6">
              <h3 class="mt-1 mb-2">Mobile Num</h3>
            </div>
            <div class="column is-6">
              <h3 class="mt-1 mb-2 rider-status"><?php echo "0".$row8['contactNo']; ?></h3>
            </div>
          </div>
          <div class="columns group">
            <div class="column is-10">
              <button class="button is-primary ml-4 mt-1 zoom" name="asignesOrders">Asigned Order</button>
            </div>
          </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </form>
  <!------XX----pop up 03/summery -------XX---------->

  <!-- --------kitchen display js file -->
  <script type="text/javascript" src="../../js/kitchendisplay.js"></script>
  <script>
    async function fetchOrderDetails() {
      try {
        const response = await fetch('/api/v1/kmonlineorders', {
          method: 'GET',
        });
        let responseData = JSON.parse(await response.text());
        console.log(responseData);

        responseData.forEach(function (entry) {
        //console.log(entry);
        document.getElementById("card-orderId").innerText=entry.orderId;
			});

    } catch (err) {
        console.log(err)
        artemisAlert.alert('error', 'Something went wrong!')
      }
    }
    setInterval(function() {
      fetchOrderDetails();
    }, 3000);
  </script>
</body>

</html>