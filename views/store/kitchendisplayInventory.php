<?php 
   session_start();
   ob_start();
   $staffid=$_SESSION['staffId'];
   $name_first=$_SESSION['firstName'];
   $name_last=$_SESSION['lastName'];
   $roleId = $_SESSION['roleId'];
  require_once './controllers/store/KitchenDisplayInventoryController.php'; 
  $kitchenDisplayInventoryController = new KitchenDisplayInventoryController();

  $result4=null;
  $output=null;
  $style = ""; //to hide the up btn
  $searchq=null;
  if (isset($_POST['search'])) 
  {
    $searchq = $_POST['search'];
    if (!($searchq == null)) 
    {
      $result4 = $kitchenDisplayInventoryController->sendSearchQuery($searchq);
    } 
    else 
    {
      $output = $kitchenDisplayInventoryController->sendSearchQuery($searchq);
    }
    $style = "style='display:block;'";
  }

  if( isset( $_POST['logout'] ) ){
    $kitchenDisplayInventoryController->logoutstaffMem();
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
  <!-- <link rel="stylesheet" href="../../css/kitchendisplay.css"> -->
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
                <button class="button is-primary  right-radius">Orders</button>
              
              </a>
              <a href="/kitchendisplay/inventory">
                <button class="button is-primary button-is-active left-radius right-radius idle">Items</button>
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
        $kitchenDisplayInventoryController->logoutstaffMem();
      }
    ?>
<!-----XX------ navigatable buttons-----XX------->


<!----------- Main section------------>


  <section>
      <div class="column is-12">           
        <div class="tabs">
          <input type="radio" id="tab1" name="tab-control" checked>
          <input type="radio" id="tab2" name="tab-control">
          <ul>
            <li title="Inventory"><label for="tab1" role="button"><br><span>Inventory</span></label></li>
            <li title="Retrieve Items"><label for="tab2" role="button"><br><span><a href="/kitchen/retrieve">Retreive Items</a></span></label></li>
          </ul>

          <div class="slider">
            <div class="indicator"></div>
          </div>
          <div class="content-1">
            <section>
              <h2>Inventory</h2>
              <div class="search-boxs ">
                <div class="search-box">
      
                  <form action="/kitchendisplay/inventory" method="POST">
                   <div class="holder">

                      <div class="columns group searchbox-holder">
                        <div class="column is-1 mb-0"></div>
                        <div class="column is-10 mb-0">
                          <input type="text" class="search-feild" placeholder="" name="search" value="" />
                          <button class="search-button"><i class="fa fa-search zoom"></i></button>
                        </div>
                        <div class="column is-1 mb-0"></div>
                      </div>

                      <div class="columns group" >
                       <div class="column is-12" id="output">
                          <?php echo $output ?>
                       </div>
                      </div>
                   </div>
                  </form>
                  
                  <div class="menu-cards" id="hide">
                    <?php                                                               
                    if(!($result4==null))
                    {
                      while($row=mysqli_fetch_assoc($result4))
                      {
                        if($row['tag']!="deleted")
                        {
                          ?>
                            <div class="container">
                              <div class="rotate-card">
                                <div class="menu-card front-face">
                                  <img src="https://image.flaticon.com/icons/svg/1775/1775636.svg">
                                  <div class="columns group">
                                    <div class="column is-6">
                                      <h3 class="mt-1 mb-0">Item_ID :</h3>
                                    </div>
                                    <div class="column is-6">
                                      <h3 class="mt-1 mb-0"><?php echo $row['inventoryId'];?></h3>
                                    </div>
                                    <div class="column is-12">
                                      <h3 class="mt-1 mb-0"><?php echo $row['itemName'] ?></h3>
                                    </div>
                                  </div>
                                </div>
                                <div class="menu-card back-face mt-2 ">
                                  <div class="columns group">
                                    <div class="column is-6">
                                      <h3 class="mt-1 mb-0">Quantity:</h3>
                                    </div>
                                    <div class="column is-6">
                                      <h3 class="mt-1 mb-0"><?php  
                                                              echo $kitchenDisplayInventoryController->getRoundOfVal($row['unitId'],$row['quantity']);
                                                              echo "(".$kitchenDisplayInventoryController->getMeasurementUnit($row['unitId']).")";
                                                            ?>
                                      </h3>
                                    </div>
                                    <div class="column is-12">
                                      <h3 class="mt-1 mb-0">Last_Retrieve_Date</h3>
                                    </div>
                                    <div class="column is-12">
                                      <h3 class="mt-1 mb-0"><?php echo $kitchenDisplayInventoryController->getLastRetrieveData($row['inventoryId']);?></h3>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          <?php
                        }
                      }
                    }
                    ?>       
                  </div>
                  <div class="columns group">
                  <div class="column is-12">
                    <button  onclick="hideSearchBox();hidebtn()" id="btnhide" class="blinking hide-up" <?php echo $style;?> >up</button>
                      <script>
                  
                        function hideSearchBox()
                        {
                          document.getElementById("hide").style.display = "none";
                        }
                        function hidebtn()
                        {
                          document.getElementById("btnhide").style.display = "none";
                          document.getElementById("output").style.display = "none";
                        }
                       
                      </script>
                  </div>
                  </div>
                </div>
              </div>
             
              <div class="menu-cards slides-holder">
                <div class=" silde slide-fade" >
                <?php
                $displayItems= $kitchenDisplayInventoryController-> getInventoryCount();
                $result2=$kitchenDisplayInventoryController->getInventoryDetails();
                 for($i=1;$i<=($displayItems+1);$i++)
                 {                                                               
                  $row=mysqli_fetch_assoc($result2);
                  if($row['tag']!="deleted")
                  {
                    ?>
                    <div class="container">
                      <div class="rotate-card">
                        <div class="menu-card front-face">
                          <img src="https://image.flaticon.com/icons/svg/1775/1775636.svg">
                          <div class="columns group">
                            <div class="column is-6">
                              <h3 class="mt-1 mb-0">Item_ID :</h3>
                            </div>
                            <div class="column is-6">
                              <h3 class="mt-1 mb-0"><?php echo $row['inventoryId'] ?></h3>
                            </div>
                            <div class="column is-12">
                              <h3 class="mt-1 mb-0"><?php echo $row['itemName'] ?></h3>
                            </div>
                          </div>
                        </div>
                        <div class="menu-card back-face mt-2 ">
                          <div class="columns group">
                            <div class="column is-6">
                              <h3 class="mt-1 mb-0">Quantity:</h3>
                            </div>
                            <div class="column is-6">
                              <h3 class="mt-1 mb-0"><?php  
                                                      echo $kitchenDisplayInventoryController->getRoundOfVal($row['unitId'],$row['quantity']);
                                                      echo "(".$kitchenDisplayInventoryController->getMeasurementUnit($row['unitId']).")";
                                                    ?>
                              </h3>
                            </div>
                            <div class="column is-12">
                              <h3 class="mt-1 mb-0">Last_Retrieve_Date</h3>
                            </div>
                            <div class="column is-12">
                              <h3 class="mt-1 mb-0"><?php echo $kitchenDisplayInventoryController->getLastRetrieveData($row['inventoryId']);?></h3>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php
                  }
                 }
                ?>    
                </div>
                <div class="silde slide-fade" >
                <?php
                
                 for($j=$i;$j<=($displayItems*2);$j++)
                 {                                                               
                  $row=mysqli_fetch_assoc($result2);
                  if($row['tag']!="deleted")
                  {
                    ?>
                       <div class="container">
                      <div class="rotate-card">
                        <div class="menu-card front-face">
                          <img src="https://image.flaticon.com/icons/svg/1775/1775636.svg">
                          <div class="columns group">
                            <div class="column is-6">
                              <h3 class="mt-1 mb-0">Item_ID :</h3>
                            </div>
                            <div class="column is-6">
                              <h3 class="mt-1 mb-0"><?php echo $row['inventoryId'] ?></h3>
                            </div>
                            <div class="column is-12">
                              <h3 class="mt-1 mb-0"><?php echo $row['itemName'] ?></h3>
                            </div>
                          </div>
                        </div>
                        <div class="menu-card back-face mt-2 ">
                          <div class="columns group">
                            <div class="column is-6">
                              <h3 class="mt-1 mb-0">Quantity:</h3>
                            </div>
                            <div class="column is-6">
                              <h3 class="mt-1 mb-0"><?php  
                                                      echo $kitchenDisplayInventoryController->getRoundOfVal($row['unitId'],$row['quantity']);
                                                      echo "(".$kitchenDisplayInventoryController->getMeasurementUnit($row['unitId']).")";
                                                    ?>
                              </h3>
                            </div>
                            <div class="column is-12">
                              <h3 class="mt-1 mb-0">Last_Retrieve_Date</h3>
                            </div>
                            <div class="column is-12">
                              <h3 class="mt-1 mb-0"><?php echo $kitchenDisplayInventoryController->getLastRetrieveData($row['inventoryId']);?></h3>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php
                  }
                 }
                ?>   
                </div>
                <div class="silde slide-fade">
                <?php
                 for($z=$j;$z<=($displayItems*3);$z++)
                 {                                                               
                  $row=mysqli_fetch_assoc($result2);
                  if($row['tag']!="deleted")
                  {
                   if($row==null)
                   {
                    break;
                   }
                   else
                   {
                    ?>
                     <div class="container">
                      <div class="rotate-card">
                        <div class="menu-card front-face">
                          <img src="https://image.flaticon.com/icons/svg/1775/1775636.svg">
                          <div class="columns group">
                            <div class="column is-6">
                              <h3 class="mt-1 mb-0">Item_ID :</h3>
                            </div>
                            <div class="column is-6">
                              <h3 class="mt-1 mb-0"><?php echo $row['inventoryId'] ?></h3>
                            </div>
                            <div class="column is-12">
                              <h3 class="mt-1 mb-0"><?php echo $row['itemName'] ?>
                            </h3>
                            </div>
                          </div>
                        </div>
                        <div class="menu-card back-face mt-2 ">
                          <div class="columns group">
                            <div class="column is-6">
                              <h3 class="mt-1 mb-0">Quantity:</h3>
                            </div>
                            <div class="column is-6">
                              <h3 class="mt-1 mb-0"><?php  
                                                      echo $kitchenDisplayInventoryController->getRoundOfVal($row['unitId'],$row['quantity']);
                                                      echo "(".$kitchenDisplayInventoryController->getMeasurementUnit($row['unitId']).")";
                                                    ?>
                              </h3>
                            </div>
                            <div class="column is-12">
                              <h3 class="mt-1 mb-0">Last_Retrieve_Date</h3>
                            </div>
                            <div class="column is-12">
                              <h3 class="mt-1 mb-0"><?php echo $kitchenDisplayInventoryController->getLastRetrieveData($row['inventoryId']);?></h3>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php
                   }
                  }
                 }
                ?>  
                </div>
                <a class="btn-prv" onclick="directSlide(-1)">&#10094;</a>
                <a class="btn-nxt" onclick="directSlide(1)">&#10095;</a>
                </div>
              <br>

              <div style="text-align:center">
                <span class="dot" onclick="directDot(1)"></span> 
                <span class="dot" onclick="directDot(2)"></span> 
                <span class="dot" onclick="directDot(3)"></span> 
              </div>

            </section>

            <section>
              <h2>Retreive Items</h2>
            </section>
          </div>
        </div>
      </div>
     
  </section>
<!----xx------- Main section----xx-------->


<!-- --------kitchen display js file -->
<script type="text/javascript" src="../../js/kitchendisplayinventory.js"></script>
</body>

</html>