<?php 
     session_start();
     ob_start();
     $staffid=$_SESSION['staffId'];
     $name_first=$_SESSION['firstName'];
     $name_last=$_SESSION['lastName'];
     $roleId = $_SESSION['roleId'];

    $page = $_SERVER['PHP_SELF'];
    $sec = "30";
    header("Refresh: $sec; url=/kitchendisplay/dinein/orders"); 

    require_once ("./controllers/store/KitchenDisplayDineinOrdersController.php"); 
    $KitchenDisplayDineinOrdersController =new KitchenDisplayDineinOrdersController();

    if( isset( $_POST['logout'] ) ){
      $KitchenDisplayDineinOrdersController->logoutstaffMem();
    }

    function ext($i_id)
    {
      $itemID = $i_id;
      return $itemID;
    }

    // $_SESSION['popup-1-dinein'] = "style=display:none";
    // $_SESSION['prepared-btn-two-dinein']="style=display:none";
    $id = null;
    $getOrderItems = null;
    if (isset($_POST['click'])) {
      $_SESSION['popup-1-dinein'] = "style=display:display";
      $ans = ext($_REQUEST['click']);
      $id = $ans;
      $_SESSION['id-dinein']=$id;
      $orderStatusBtn = $KitchenDisplayDineinOrdersController->getOrderStatusBtn($_SESSION['id-dinein']);
      $row = mysqli_fetch_assoc($orderStatusBtn);
      if ($row['orderStatus'] == "1") {
         $_SESSION['accpt-dec-btns-dinein'] = "style=display:block";
        //  $_SESSION['rider-btn-dinein'] = "style=display:block";
      }else if ($row['orderStatus'] == "2") {
        $_SESSION['accpt-dec-btns-dinein'] = "style=display:none";
        $_SESSION['rider-btn-dinein'] = "style=display:block";
      } else if ($row['orderStatus'] == "3") {
         $_SESSION['accpt-dec-btns-dinein'] = "style=display:none";
         $_SESSION['rider-btn-dinein'] = "style=display:none";
        $_SESSION['prepared-btn-two-dinein'] = "style=display:block";
      } else if ($row['orderStatus'] == "5") {
         $_SESSION['accpt-dec-btns-dinein'] = "style=display:none";
         $_SESSION['rider-btn-dinein'] = "style=display:none";
        $_SESSION['prepared-btn-one-dinein']= "style=display:none";
        $_SESSION['prepared-btn-two-dinein'] = "style=display:none";
      } else {
        $_SESSION['accpt-dec-btns-dinein'] = "style=display:none";
        $_SESSION['rider-btn-dinein'] = "style=display:none";
       $_SESSION['prepared-btn-one-dinein']= "style=display:none";
       $_SESSION['prepared-btn-two-dinein'] = "style=display:none";
      }
      $getOrderItems = $KitchenDisplayDineinOrdersController->getOrderItems($_SESSION['id-dinein']);
    }
    if (isset($_POST['accept-btn'])) {
      $orId = $_POST['orId'];
      $_SESSION['popup-1-dinein'] = "style=display:none";
      $KitchenDisplayDineinOrdersController->updateToAccept($orId);
    }
    if (isset($_POST['decline-btn'])) {
      $orId = $_POST['orId'];
      $_SESSION['popup-1-dinein'] = "style=display:none";
      $KitchenDisplayDineinOrdersController->updateToDecline($orId);
      
    }
    // $_SESSION['popup-rider-dinein'] = "style=display:none";
    $getRiders = null;
    if (isset($_POST['riders'])) {
      $_SESSION['popup-rider-dinein'] = "style=display:display";
      $_SESSION['popup-1-dinein'] = "style=display:display";
      $_SESSION['accpt-dec-btns-dinein'] = "style=display:none";
      $_SESSION['rider-btn-dinein'] = "style=display:block";
      $orId = $_POST['orId'];
      $id = $orId;
      $getOrderItems = $KitchenDisplayDineinOrdersController->getOrderItems($orId);
      $getRiders = $KitchenDisplayDineinOrdersController->getRiders();
    }
    //$_SESSION['popup-summery-dinein'] = "style=display:none";
    if (isset($_POST['click-2'])) {
      $ans = ext($_REQUEST['click-2']);
      $_SESSION['sid-dinein']= $ans;
      $ordeId=$_POST['ordeId'];
      // echo $ordeId." ".$sid;
       $_SESSION['popup-summery-dinein'] = "style=display:display";
       $_SESSION['popup-rider-dinein'] = "style=display:display";
       $_SESSION['popup-1-dinein']= "style=display:display";
       $_SESSION['accpt-dec-btns-dinein'] = "style=display:none";
       $_SESSION['rider-btn-dinein'] = "style=display:block";
      $id = $ordeId;
      $getOrderItems = $KitchenDisplayDineinOrdersController->getOrderItems($ordeId);
      $getRiders = $KitchenDisplayDineinOrdersController->getRiders();
    }
  //  $_SESSION['prepared-btn-one-dinein']= "style=display:none";
    if (isset($_POST['asignesOrders'])) {
      $assOrId= $_POST['assOrId'];
      $dateAndTime= $_POST['dateAndTime'];
      $fName= $_POST['fName'];
      $assSId= $_POST['assSId'];
      // echo $assOrId,$dateAndTime,$fName,$assSId;
      $checkRiderAvail=$KitchenDisplayDineinOrdersController->orderAssign($assOrId,$assSId, $dateAndTime,$fName);
      if($checkRiderAvail==1)
      {
        $_SESSION['popup-1-dinein'] = "style=display:display";
        $_SESSION['accpt-dec-btns-dinein'] = "style=display:none";
        $_SESSION['rider-btn-dinein'] = "style=display:none";
        $_SESSION['popup-rider-dinein'] = "style=display:none";
        $_SESSION['popup-summery-dinein']="style=display:none";
        $id = $assOrId;
        $getOrderItems = $KitchenDisplayDineinOrdersController->getOrderItems($assOrId);
        $_SESSION['prepared-btn-one-dinein']= "style=display:block";
      }
      else if($checkRiderAvail==0)
      {
        $_SESSION['popup-1-dinein'] = "style=display:none";
        $_SESSION['accpt-dec-btns-dinein'] = "style=display:none";
        $_SESSION['rider-btn-dinein'] = "style=display:none";
        $_SESSION['popup-rider-dinein'] = "style=display:none";
        $_SESSION['popup-summery-dinein'] = "style=display:none";
        //  $id = $assOrId;
        //  $getOrderItems = $KitchenDisplayOrdersController->getOrderItems($assOrId);
        //  $_SESSION['prepared-btn-one'] = "style=display:none";
      }
     
      // $KitchenDisplayDineinOrdersController->updateToAssigned($assOrId,$dateAndTime);
      // $KitchenDisplayDineinOrdersController->updateRiderStatus($assSId);
    }
    if (isset($_POST['prepared1'])) {
      $orId = $_POST['orId'];
      $KitchenDisplayDineinOrdersController->updateToPrepared($orId);
      $_SESSION['prepared-btn-one-dinein']= "style=display:none";
      $_SESSION['prepared-btn-two-dinein']= "style=display:none";
      $_SESSION['popup-1-dinein'] = "style=display:none";
    }
    if (isset($_POST['prepared2'])) {
      $orId = $_POST['orId'];
      $KitchenDisplayDineinOrdersController->updateToprepared($orId);
      $_SESSION['prepared-btn-one-dinein']= "style=display:none";
      $_SESSION['prepared-btn-two-dinein']= "style=display:none";
      $_SESSION['popup-1-dinein'] = "style=display:none";
    }
    if (isset($_POST['close-btn'])) {
      $_SESSION['accpt-dec-btns-dinein'] = "style=display:none";
      $_SESSION['rider-btn-dinein'] = "style=display:none";
      $_SESSION['popup-1-dinein'] = "style=display:none";
      $_SESSION['popup-rider-dinein'] = "style=display:none";
      $_SESSION['popup-summery-dinein'] = "style=display:none";
      $_SESSION['prepared-btn-two-dinein']= "style=display:none";
      $_SESSION['prepared-btn-one-dinein']= "style=display:none";
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
  <link rel="stylesheet" href="../../css/kitchendisplay.css">
  <link rel="icon" type="image/png" href="../../img/favicon.png" />
  <link rel="stylesheet" href="../../plugins/ArtemisAlert/ArtemisAlert.css">
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
    if($roleId=="2")
    {
      
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
    }
    else
    {
      $KitchenDisplayDineinOrdersController->logoutstaffMem();
    }
  ?>
<!-----XX------ navigatable buttons-----XX------->

<!----------- Main section------------>
  <section>
      <div class="column is-12">           
        <div class="tabs">
        <input type="radio" id="tab1" name="tab-control" >
          <input type="radio" id="tab2" name="tab-control" checked>
          <ul>
            <li title="O_Orders"><label for="tab1" role="button"><a href="/kitchendisplay/orders"><br><span>O_Oders</span></a></label></li>
            <li title="D_Orders"><label for="tab2" role="button"><br><span>D_Oders</span></label></li>
          </ul>
          <div class="slider">
            <div class="indicator"></div>
          </div>
          <div class="content-1">
            <section>
              <h2>O_Orders</h2>
             
            </section>
            <section>
              <h2>D_Orders</h2>
              <div class="menu-cards">
              <?php
              $result = $KitchenDisplayDineinOrdersController->getOrderDetails();
              while ($row = mysqli_fetch_assoc($result)) 
              {
                $arrivedTime= $row['timestamp'];
                date_default_timezone_set("Asia/Colombo");
                $orderDate=date('Y/m/d',  $arrivedTime);
                $today= date('Y/m/d');
                if($orderDate==$today &&  $row['orderStatus'] !=8)
                {
                ?>
                  <form class="click-btn" action="" method="POST">
                    <div class="menu-card card-zoom" onclick="togglePopup();togglePopup1()" name="menu-card-details">
                      <button name="click" class="click-btn" value="<?php echo $row['orderId'] ?>">
                        <img src="https://image.flaticon.com/icons/svg/1775/1775636.svg">
                      </button>
                      <div class="columns group">
                        <div class="column is-6">
                          <h3 class="mt-1 mb-0">Order ID:</h3>
                        </div>
                        <div class="column is-6">
                          <h3 class="mt-1 mb-0" name="orderId"><?php echo $row['orderId'] ?></h3>
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
                      } else if ($row['orderStatus'] == "3") {
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
                      }else if ($row['orderStatus'] > 5){
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
                // else
                // {
                //   // echo "No any online orders for today: ".$today;
                // }
              }
              ?>
            </div>
             
            </section>
    
          </div>
        </div>
      </div>
     
  </section>
<!----xx------- Main section----xx-------->

<!------------pop up orders-------------->
<section>
    <form action="" method="POST">
      <div <?php echo $_SESSION['popup-1-dinein'] ?> class="popup-update" id="popup-1">
        <div class="popup-overlay-update" id="editOverlay"></div>
        <div class="pop-content-update placement-top">
          <button name="close-btn">
            <div class="close-btn-update zoom" onclick="closepopup01()">&times;</div>
          </button>
          <div class="card">
            <h2 class="orange-color mt-0 mb-1">Order <?php echo $_SESSION['id-dinein']; ?> </h2>
            <input type="hidden" value="<?php echo $_SESSION['id-dinein']; ?>" name="orId">
            <?php
            $getOrderItems = $KitchenDisplayDineinOrdersController->getOrderItems($_SESSION['id-dinein']);
            if ($getOrderItems != null) {
              while ($row2 = mysqli_fetch_assoc($getOrderItems)) {
            ?>

                <!------- show ordered list ----------->
                <div class="order-selected-item">
                  <div class="order-selected-row">
                    <div class="order-selected-row-image">
                        <!-- <img src="https://image.flaticon.com/icons/svg/184/184410.svg" alt="no image"> -->
                        <?php
                          $result9 =$KitchenDisplayDineinOrdersController->getItemImage($row2['itemNo']);
                          $row9 = mysqli_fetch_assoc($result9); 
                          ?>
                              <img src="<?php echo"../../".$row9['url'];?>" alt="no image">
                          <?php
                          
                        ?>
                    </div>
                    <div class="order-selected-row-description has-text-left">
                      <h4 class="mb-0 mt-0">
                        <?php
                        $result3 = $KitchenDisplayDineinOrdersController->getItemName($row2['itemNo']);
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
          <div class="card hide-scrol-bar" style="height:120px; overflow:auto">
            <div class="columns group font">
              <div class="column is-6">
                <h3 class="mt-1 mb-1">Total Amount</h3>
              </div>
              <div class="column is-6" ><h3>
                <?php
                  $result4 =$KitchenDisplayDineinOrdersController->getTotal($_SESSION['id-dinein']);
                  $row4 = mysqli_fetch_assoc($result4);
                  echo "Rs " . $row4['amount'];

                  ?></h3>
              </div>
            </div>
            <div class="columns group font">
              <div class="column is-6">
                <h3 class="mt-1 mb-1">Table No</h3>
              </div>
              <div class="column is-6" ><h3>
                <?php
                  $result6 =$KitchenDisplayDineinOrdersController->getAddress($_SESSION['id-dinein']);
                  $row6 = mysqli_fetch_assoc($result6);
                  echo $row6['tableNo'];

                  ?></h3>
              </div>
            </div>
            <div class="columns group font">
              <div class="column is-6">
                <h3 class="mt-1 mb-1">Arived Time</h3>
              </div>
              <div class="column is-6" ><h3>
                <?php
                  $result5 =$KitchenDisplayDineinOrdersController->getDateAndTime($_SESSION['id-dinein']);
                  $row5 = mysqli_fetch_assoc($result5);
                  if($row5['timestamp'] !=0)
                  { 
                    $arrivedTime= $row5['timestamp'];
                    date_default_timezone_set("Asia/Colombo");
                    echo date('Y/m/d H:i:s',  $arrivedTime);
                  }
                  ?></h3>
              </div>
            </div>
            <div class="columns group font">
              <div class="column is-6">
                <h3 class="mt-1 mb-1" >Assigned Time<h3>
              </div>
              <div class="column is-6" ><h3>
                <?php
                  $result5 =$KitchenDisplayDineinOrdersController->getAssignedDateAndTime($_SESSION['id-dinein']);
                  $row5 = mysqli_fetch_assoc($result5);
                  if( $row5['assignedTime'] != 0)
                  {
                    $assignedTime= $row5['assignedTime'];
                    date_default_timezone_set("Asia/Colombo");
                    echo date('Y/m/d H:i:s',   $assignedTime);
                  }
                  ?></h3>
              </div>
            </div>
            <div class="columns group font">
              <div class="column is-6">
                <h3 class="mt-1 mb-1" >Prepared Time</h3>
              </div>
              <div class="column is-6" ><h3>
                <?php
                  $result5 =$KitchenDisplayDineinOrdersController->getPreparedDateAndTime($_SESSION['id-dinein']);
                  $row5 = mysqli_fetch_assoc($result5);
                  if($row5['preparedTime'] != 0)
                  {
                    $preparedTime= $row5['preparedTime'];
                    date_default_timezone_set("Asia/Colombo");
                    echo date('Y/m/d H:i:s',  $preparedTime);
    
                  }
                  ?></h3>
              </div>
            </div>
          </div>
          <div class="columns group font">
            <div class="column is-6" id="btnAccept" <?php echo  $_SESSION['accpt-dec-btns-dinein'] ?>>
              <button class="button is-primary mt-1 zoom  resizebtn"  name="accept-btn">Accept</button>
            </div>
            <div class="column is-6" id="btnDecline" <?php echo  $_SESSION['accpt-dec-btns-dinein'] ?>>
              <button class="button is-danger mt-1 zoom resizebtn" onclick="return confirm('Are you sure you want to decline this order?');" id="switch-decline-orders" name="decline-btn">Decline</button>
            </div>
          </div>
          <div class="columns group font">
            <div class="column is-12" id="btnRiders" <?php echo  $_SESSION['rider-btn-dinein'] ?>>
              <button class="button is-link mt-1 zoom mr-1 resizebtn" name="riders">Stewards</button>
            </div>
            <div class="column is-12" id="btnPrepared"  <?php echo$_SESSION['prepared-btn-one-dinein']?> >
              <button class="button is-success mt-1 mr-1 zoom resizebtn" name="prepared1">Prepared</button>
            </div>
            <div class="column is-12" id="btnPrepared"   <?php echo $_SESSION['prepared-btn-two-dinein'] ?>>
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
      document.getElementById("popup-3").style.display = "none";
    }
    function closepopup03() {
      document.getElementById("popup-3").style.display = "none";
    }
  </script>
<!---------xx---pop up orders-----xx--------->

<!----------pop up steward ----------------->
<section>
    <div <?php echo $_SESSION['popup-rider-dinein'] ?> class="popup-update" id="popup-2">
      <div class="pop-content-update-riders">
        <!-- <div class="card"> -->
        <div class="close-btn-update-riders zoom" onclick="closepopup02()">&times;</div>
        <?php
        $getRiders =$KitchenDisplayDineinOrdersController->getRiders();
        if ($getRiders != null) {
          while ($row6 = mysqli_fetch_assoc($getRiders)) {
        ?>
            <form action="" method="POST">
              <div class="menu-cards mt-2 ">
                <div class="dp-card" >
                  <div class="columns group">
                    <div class="column is-6">
                      <h3 class="mt-1 mb-0">Steward <?php echo $row6['staffId']; ?></h3>
                    </div>
                    <div class="column is-6">
                      <h3 class="mt-1 mb-0 rider-status">
                        <?php
                        $result7 = $KitchenDisplayDineinOrdersController->getRiderStatus($row6['staffId']);
                        $row7 = mysqli_fetch_assoc($result7);
                        // echo $id;
                        if($row7['status']=="AVAILABLE")
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
<!------XX----pop up steward -------XX---------->

<!----------pop up 03/ summery ----------------->
<form action="" method="POST">
  <div class="popup" id="popup-3" <?php echo  $_SESSION['popup-summery-dinein'] ?>>
    <div class="pop-content3">
    <div class="close-btn-update-riders zoom" onclick="closepopup03()">&times;</div>

      <h2 class="orange-color mt-0 mb-1 ">Order Asign Summery</h2>
      <div class="menu-cards">
        <div class="asiggned-summery-card">
          <div class="columns group">
            <div class="column is-3 mr-1">
              <h3 class="mt-1 mb-2">Order Id</h3>
            </div>
            <div class="column is-2 mr-1 ml-0">
              <h3 class="mt-1 mb-2 rider-status"><?php echo$_SESSION['id-dinein'];?></h3>
              <input type="hidden" value="<?php echo $_SESSION['id-dinein'];?>" name="assOrId" >
            </div>
            <div class="column is-3 ml-1 mr-1">
            <h3 class="mt-1 mb-2">Rider ID</h3>
            </div>
            <div class="column is-2 ml-0">
              <h3 class="mt-1 mb-2 rider-status"><?php echo $_SESSION['sid-dinein'];?></h3>
              <input type="hidden" value="<?php echo $_SESSION['sid-dinein'];?>" name="assSId" >
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
          <!-- <div class="columns group">
            <div class="column is-6">
              <h3 class="mt-1 mb-2">Table Num</h3>
            </div>
            <div class="column is-6">
            <h3 class="mt-1 mb-2 rider-status">
                                                  <?php
                                                    $result6 = $KitchenDisplayDineinOrdersController->getAddress($_SESSION['id-dinein']);
                                                    $row6 = mysqli_fetch_assoc($result6);
                                                    echo $row6['tableNo'];

                                                    ?>
                                                  </h3>
            </div>
          </div> -->
          <div class="columns group">
            <div class="column is-6">
              <h3 class="mt-1 mb-2">Name</h3>
            </div>
            <div class="column is-6">
              <h3 class="mt-1 mb-2 rider-status"> <?php
                                                    $result8 = $KitchenDisplayDineinOrdersController->riderName($_SESSION['sid-dinein']);
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
</body>

<?php
  if (isset($_GET['attempt'])) {
    if ($_GET['attempt'] == 'false') {
      echo "<script> artemisAlert.alert('error', 'login failed')</script>";
    }
  }
  ?>

</html>
