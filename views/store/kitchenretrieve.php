<?php 
     session_start();
     ob_start();
     $staffid=$_SESSION['staffId'];
     $name_first=$_SESSION['firstName'];
     $name_last=$_SESSION['lastName'];
     $roleId = $_SESSION['roleId'];
    require_once './controllers/store/KitchenRetrieveController.php'; 
    $KitchenRetriveController=new KitchenRetrieveController();
    $result4=null;
    $output=null;
    $style = ""; //to hide the up btn 
    if(isset($_POST['search']))
    {
        $searchq = $_POST['search'];
        if ($searchq == null) {
            $output = $KitchenRetriveController->sendSearhQuery($searchq);
        } else {

            $result4 = $KitchenRetriveController->sendSearhQuery($searchq);
        }
        $style = "style='display:block;'";
    }
    if( isset( $_POST['logout'] ) ){
      $KitchenRetriveController->logoutstaffMem();
    }
?>  

<?php

    if(isset($_POST['sendbtn'])){
      $newq=$_POST['newq'];
      $oldq=$_POST['oldq'];
      $unitId=$_POST['unitId'];
      $itemId=$_POST['itemId'];
      $KitchenRetriveController->getInputVal($newq,$oldq,$unitId,$itemId);
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
  <link rel="stylesheet" href="../../plugins/ArtemisAlert/ArtemisAlert.css">
  <!-- <link rel="stylesheet" href="../../css/kitchendisplay.css"> -->
  <title>kitchen Retrieve</title>
  <!-- <script type="text/javascript" src="../../js/kitchendisplay.js"></script> -->

</head>

<body onload="hideUpbtn()">

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
              <button class="button is-primary right-radius">Orders</button>
            
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
        $KitchenRetriveController->logoutstaffMem();
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
            <li title="Ineventory"><label for="tab1" role="button"><br><span> <a href="/kitchendisplay/inventory">Inventory</a></span></label></li>
            <li title="Retrieve  Items"><label for="tab2" role="button"><br><span>Retrieve Items</span></label></li>
          </ul>

          <div class="slider">
            <div class="indicator"></div>
          </div>
          <div class="content-1">
            <section>
           <h2>Inventory</h2>
              

            </section>

            <section>
              <h2>Retreive Items</h2>
              <div class="search-boxs ">
                <div class="search-box ">
      
                  <form  method="POST" action="/kitchen/retrieve">
                   <div class="holder ">
                      <div class="columns group">
                        <div class="column is-11">
                          <input type="text" class="search-feild"  name="search" />
                          <button  class=" search-button fa fa-search zoom"></button>
                        </div>
                        <div class="column is-1">
                          
                        </div>
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
                                                                            
                    if($result4!=null)
                    {
                      while($row=mysqli_fetch_assoc($result4))
                      {
                        if($row['tag']!="DELETED")
                        {
                          ?>
                            <form  method="POST" action="/kitchen/retrieve">
                            <div class="container">
                                <div class="menu-card">
                                  <img src="<?php echo  "../../".$row['url'];?>">
                                  <div class="columns group">
                                    <div class="column is-6">
                                      <h3 class="mt-1 mb-0">Item_ID :</h3>
                                    </div>
                                    <div class="column is-6">
                                      <input type="hidden" name="itemId" value="<?php echo $row['inventoryId'];?>">
                                      <h3 class="mt-1 mb-0"><?php echo $row['inventoryId'];?></h3>
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
                                      <input type="hidden" name="oldq" value="<?php echo $row['quantity'];?>">
                                      <input type="hidden" name="unitId" value="<?php echo $row['unitId'];?>">
                                      <h3 class="mt-1 mb-0"><?php  
                                                              echo $KitchenRetriveController->getRoundOfVal($row['unitId'],$row['quantity']);
                                                              echo "(".$KitchenRetriveController->getMeasurementUnit($row['unitId']).")";
                                                            ?>
                                      </h3>
                                    </div>
                                  </div>
                                  <div class="columns group">
                                    <div class="column is-12">
                                        <h3 class="mt-1 mb-0 f-size"><input type="text" name="newq" class="retreive-quantity-txtbox" ><?php echo "(".$KitchenRetriveController->getMeasurementUnit($row['unitId']).")" ?></h3>
                                    </div>
                                  </div>
                                  <div class="columns group">
                                    <div class="column is-12">
                                      <h3 class="mt-1 mb-0"><button name="sendbtn" class="retreive-quantity-addbtn">Retrieve</button></h3>
                                    </div>
                                    </form>
                                  </div>
                                </div>
                              <!-- </div> -->
                            </div>
                          <?php
                        }
                      }
                    }
                    ?>  
                       
                  </div>
                  <div class="columns group">
                    <div class="column is-12 ">
                      <button  onclick="hideSearchBox();hidebtn()" id="btnhide" class="blinking hide-up" <?php echo $style;?> >up</button>
                    </div>
                  </div>
                </div>
                                     
              </div>
            </section>
          </div>
        </div>
      </div>
     
  </section>
<!----xx------- Main section----xx-------->



<!-- --------kitchen display js file -->
<script type="text/javascript" src="../../js/kitchenretrieve.js"></script>
</body>
<?php
  if (isset($_GET['attempt'])) {
    if ($_GET['attempt'] == 'false') {
      echo "<script> artemisAlert.alert('error', 'login failed')</script>";
    }
  }
  ?>

</html>