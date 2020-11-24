<?php require_once ("./controllers/store/KitchenDisplayDineinOrdersController.php"); 
    $KitchenDisplayDineinOrdersController =new KitchenDisplayDineinOrdersController();
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
  <title>kitchen Display</title>
  <!-- <script type="text/javascript" src="../../js/kitchendisplay.js"></script> -->

</head>

<body>
<!-- -----navi bar ---------- -->
<div class="navbar">
    <div class="columns group">
      <div class="column is-2">
        <img src="../../img/logo.png" height=56 width="224" />
      </div>
      <div class="column is-6 ml-5"></div>
      <div class="column is-3 has-text-right nav-logout">
        <i class="fa fa-user" aria-hidden="true"></i>
        <span class="mr-1">Kitchen Manager</span>
        <button class="button is-primary">Logout</button>
      </div>
    </div>
  </div>
<!--------xx-----navi bar --------xx------->

<!----------- Main section------------>
  <section>
    <div class="row buttons-row">
      <a href="/kitchendisplay/orders">
        <button class="button is-primary button-is-active right-radius">Orders</button>
      
      </a>
      <a href="/kitchendisplay/inventory">
        <button class="button is-primary left-radius idle">Items</button>
      </a>
    </div>
  </section>

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
          <div class="content">
            <section>
              <h2>O_Orders</h2>
             
            </section>
            <section>
              <h2>D_Orders</h2>
              <div class="menu-cards">
              <?php
                $result = $KitchenDisplayDineinOrdersController->getOrderDetails();                                                               
                while($row=mysqli_fetch_assoc($result))
				        {
                  ?>
                    <div class="menu-card card-zoom" onclick="togglePopup();togglePopup1()" name="menu-card-details">
                      <img src="https://image.flaticon.com/icons/svg/1775/1775636.svg">
                                
                      <div class="columns group">
                        <div class="column is-6">
                          <h3 class="mt-1 mb-0">Order ID:</h3>
                        </div>
                        <div class="column is-6">
                          <h3 class="mt-1 mb-0" name="orderId"><?php echo $row['orderId'] ?></h3>
                        </div>
                      </div>
                      <div class="columns group menu-card-visibility" id="showAccepted">
                        <div class="column is-12">
                          <h3 class="mt-1 mb-0 color-accept" >Accepted</h3>
                        </div>
                      </div>
                      <div class="columns group">
                        <div class="column is-12 menu-card-visibility" id="showAssigned">
                          <h3 class="mt-1 mb-0 color-assign">Assigned</h3>
                        </div>
                      </div>
                      <div class="columns group">
                        <div class="column is-12 menu-card-visibility" id="btnPrepare">
                          <h3 class="mt-1 mb-0 color-prepare" >Prepared</h3>
                        </div>
                      </div>
                    </div>
                  <?php
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
<div class="popup" id="popup-1">
  <div class="overlay"></div>
  <div class="pop-content">
    <div class="close-btn zoom"  onclick="closepopup01()">&times;</div>
     <div class="column is-12 ml-0 mr-0">
        <div class="card">
          <h2 class="orange-color mt-0 mb-1">Order 5667lH</h2>

            <!------- show ordered list ----------->
            <div class="order-selected-item">
              <div class="order-selected-row">
                <div class="order-selected-row-image">
                  <img src="https://image.flaticon.com/icons/svg/184/184410.svg">
                </div>
                <div class="order-selected-row-description has-text-left">
                  <h4 class="mb-0 mt-0">Chinese Ramen</h4>
                </div>
                <div class="order-selected-row-quantity">
                  <h4 class="mb-0 mt-0">1</h4>
                </div>
              </div>
            </div>
          </div>
          <!----XX--- show ordered list ------XX----->
          <div class="total-box d-flex">
            <div class="title-col">
              <h3 class="mt-1 mb-1">Total Amount</h3>
              <h3 class="mt-1 mb-1">Arived Time</h3>
              <h3 class="mt-1 mb-1">Table Number</h3>
            </div>
            <div class="price-col has-text-right mr-1">
            <h3 class="mt-1 mb-1">450.00</h3>
            <h3 class="mt-1 mb-1">10:20 pm</h3>
            <h3 class="mt-1 mb-1">05</h3>
            </div>
          </div>
          <!------accept/decline btn -------->
          <div class="columns group">
            <div class="column is-6"  id="btnAccept">
               <button class="button is-primary mt-1 zoom  resizebtn" onclick="hideAcceptDecline()" name="update-orStatus" >Accept</button>
            </div>
            <div class="column is-12" id="btnSteward">
              <button class="button is-link mt-1 zoom mr-1 resizebtn" onclick="togglePopup2()"> Available Stewards</button>
           </div>
            <div class="column is-12" id="btnPrepared">
              <button class="button is-success mt-1 mr-1 zoom resizebtn" onclick="closepopup01();showPrepare()">Prepared</button>
           </div>
            <div class="column is-6" id="btnDecline">
               <button class="button is-danger mt-1 zoom resizebtn" id="switch-decline-orders">Decline</button>
            </div>
            <script>
              function hideAcceptDecline() {
                document.getElementById("btnAccept").style.display = "none";
                document.getElementById("btnDecline").style.display = "none";
                document.getElementById("btnSteward").style.display = "block";
                document.getElementById("showAccepted").style.display = "block";
              }
              function closepopup01(){
                document.getElementById("popup-1").style.display = "none";
              }
              // here popup-1 get open but to open it frist with black transparent window for the first time need
              // to call togglePopup() which is in js file 
              function togglePopup1(){

                document.getElementById("popup-1").style.display = "block";
 
              }
              function showPrepare(){

                document.getElementById("btnPrepare").style.display = "block";
 
              }

            </script>
            
          </div>
           <!-----XX---accept/decline btn ---XX------>
        </div>
      </div>
      
  </div>
</div>
<!---------xx---pop up orders-----xx--------->

<!----------pop up delivery people ----------------->
<div class="popup" id="popup-2">
  <div class="pop-content2">
    <div class="close-btn" onclick="togglePopup2()">&times;</div><br><br>
    <h2 class="orange-color mt-0 mb-1 ml-3">Available Stewards</h2>
    <div class="menu-cards">
      <div class="dp-card" onclick="togglePopup3()">
        <div class="columns group">
          <div class="column is-6">
            <h3 class="mt-1 mb-0">Steward 025R</h3>
          </div>
          <div class="column is-6">
            <h3 class="mt-1 mb-0 rider-status">Free</h3>
          </div>
        </div>
      </div>
    </div>
    <div class="menu-cards">
      <div class="dp-card" onclick="togglePopup3()">
        <div class="columns group">
          <div class="column is-6">
            <h3 class="mt-1 mb-0">Steward xxxx</h3>
          </div>
          <div class="column is-6">
            <h3 class="mt-1 mb-0 rider-status">Free</h3>
          </div>
        </div>
      </div>
    </div>
    <div class="menu-cards">
      <div class="dp-card" onclick="togglePopup3()">
        <div class="columns group">
          <div class="column is-6">
            <h3 class="mt-1 mb-0">Steward xxxx</h3>
          </div>
          <div class="column is-6">
            <h3 class="mt-1 mb-0 rider-status">Free</h3>
          </div>
        </div>
      </div>
    </div>
    <div class="menu-cards">
      <div class="dp-card" onclick="togglePopup3()">
        <div class="columns group">
          <div class="column is-6">
            <h3 class="mt-1 mb-0">Steward xxxx</h3>
          </div>
          <div class="column is-6">
            <h3 class="mt-1 mb-0 rider-status">Free</h3>
          </div>
        </div>
      </div>
    </div>
    
  </div>
</div>
<!------XX----pop up delivery people -------XX---------->

<!----------pop up 03/ summery ----------------->
<div class="popup" id="popup-3">
  <div class="pop-content3">
    <div class="close-btn" onclick="togglePopup3()">&times;</div><br><br>

    <h2 class="orange-color mt-0 mb-1 ">Order Asign Summery</h2>
    <div class="menu-cards">
      <div class="asiggned-summery-card" >
        <div class="columns group">
          <div class="column is-6">
            <h3 class="mt-1 mb-2">Order Id</h3>
            <h3 class="mt-1 mb-2">Assigned Time</h3>
            <h3 class="mt-1 mb-2">Tbale Number</h3>
            <h3 class="mt-1 mb-2">________________________</h3>
            <h3 class="mt-1 mb-2">Steward ID</h3>
            <h3 class="mt-1 mb-2">Steward Name</h3>
          </div>
          <div class="column is-6">
            <h3 class="mt-1 mb-2 rider-status">___________</h3>
            <h3 class="mt-1 mb-2 rider-status">___________</h3>
            <h3 class="mt-1 mb-2 rider-status">___________</h3>
            <h3 class="mt-1 mb-2 rider-status">___________</h3>
            <h3 class="mt-1 mb-2 rider-status">___________</h3>
            <h3 class="mt-1 mb-2 rider-status">___________</h3>    
          </div>
         <script>
           function displayPrepared()
           {
            document.getElementById("btnSteward").style.display = "none"; 
            document.getElementById("btnPrepared").style.display = "block";
            document.getElementById("btnAsignOrders").style.display = "none";
            document.getElementById("popup-2").style.display = "none";
            document.getElementById("popup-3").style.display = "none";
            document.getElementById("showAssigned").style.display = "block";
                
           }

         </script>
        </div>
      </div>
          <div class="column is-12">
            <button class="button is-primary  mt-1 zoom"  onclick="displayPrepared()" id="btnAsignOrders">Asigned Order</button>
          </div>
    </div>
    
    
  </div>
</div>
<!------XX----pop up 03/summery -------XX---------->

<!-- --------kitchen display js file -->
<script type="text/javascript" src="../../js/kitchendisplay.js"></script>
</body>

</html>