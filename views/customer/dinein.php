<?php
  session_start();
  ob_start();
  echo $_SESSION['user_phone'];

  if(!isset($_SESSION['user_phone'])){
      header('Location: /dinein/login');
  }

  require_once './controllers/customer/DineinController.php';
  //Initiate an instance of controller
  $DineinController = new DineinController();

  if( isset( $_POST['logout'] ) ){
    $DineinController->logout();
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
  <link rel="stylesheet" href="../../css/onlineOrderStyles.css">
  <link rel="stylesheet" href="../../plugins/ArtemisAlert/ArtemisAlert.css">
  <title>Online Order</title>
</head>

<body>
  <div class="navbar">
    <div class="columns group">
      <div class="column is-2">
        <img src="../../img/logo.png" height=56 width="224" />
      </div>
      <div class="column is-10 has-text-right nav-logout">
        <i class="fa fa-user" aria-hidden="true"></i>
        <a class="navbar-link" href="/online/profile">
          <?php
            $DineinController->renderNavBar($_SESSION['user_phone']);
          ?> 
        </a>  
        <form class="d-inline" action="/online" method="POST">
          <button class="button is-primary" name="logout">Logout</button>
        </form>
      </div>
    </div>
  </div>

  <section>
    <div class="columns group">
      <div class="column is-8">
        <div class="tabs">
          <input type="radio" id="tab1" name="tab-control" checked>
          <input type="radio" id="tab2" name="tab-control">
          <input type="radio" id="tab3" name="tab-control">
          <input type="radio" id="tab4" name="tab-control">
          <ul>
            <li title="Mains"><label for="tab1" role="button"><i class="fas fa-hamburger mr-1"></i><br><span>Mains</span></label></li>
            <li title="Starters"><label for="tab2" role="button"><i class="fas fa-hotdog mr-1"></i><br><span>Starters</span></label></li>
            <li title="Beverages"><label for="tab3" role="button"><i class="fas fa-beer mr-1"></i><br><span>Beverages</span></label></li>
            <li title="Desserts"><label for="tab4" role="button"><i class="fas fa-cookie mr-1"></i><br><span>Desserts</span></label></li>
          </ul>
          <div class="slider">
            <div class="indicator"></div>
          </div>
          <div class="content">
            <section>
              <h2>Mains</h2>
              <div class="menu-cards">
                <?php
                  $DineinController->renderMainMenu();
                ?>
            </section>
            <section>
              <h2>Starters</h2>
              <div class="menu-cards">
                <?php
                  $DineinController->renderSidesMenu();
                ?>
              </div>
            </section>
            <section>
              <h2>Beverages</h2>
              <?php
                $DineinController->renderBeveragesMenu();
              ?>
            </section>
            <section>
              <h2>Desserts</h2>
              <?php
                $DineinController->renderDessertMenu();
              ?>
            </section>
          </div>
        </div>
      </div>
      <div class="column is-4 ml-0 mr-0">
        <div class="card">
          <h1 class="orange-color mt-0 mb-1">Order Summery</h1>
          <div class="menu-selected" id="selected-menu">
          </div>
          <div class="total-box d-flex">
            <div class="title-col">
              <h3 class="mt-1 mb-1">Total Amount</h3>
            </div>
            <div class="price-col has-text-right mr-1">
            <h3 id="price-tag" class="mt-1 mb-1">0.00</h3>
            </div>
          </div>
          <form action="/dinein/order" method="POST">
            <input id="confirmed-total" name="totalValue" value="0" style="display:none">
            <input id="order-array" type="text" name="orderArray" value="0" style="display:none">
            <button class="button is-primary mt-1 fadeInRight">Place Order</button>
          </form>
          
        </div>
      </div>
    </div>
  </section>

<script src="../../plugins/ArtemisAlert/ArtemisAlert.js"></script>
<script>
  const delay = ms => new Promise(res => setTimeout(res, ms));
  let counter = false;
  let total = 0;
  let order = {};

  function addToCart(itemId){

    if(itemId in order){
      artemisAlert.alert('warning', 'Item Already Exists!');
      return;
    }

    let itemName = 'name-'+itemId;
    let ItemPrice = 'price-'+itemId;
    let imageUrl = 'item-picture-'+itemId;

    if(!counter){
      counter = true;
      document.getElementById("menu-"+itemId).innerHTML = document.getElementById("menu-"+itemId).innerHTML + "<div id='fadetemp'>" + document.getElementById("menu-"+itemId).innerHTML + '</div>';
      document.getElementById("fadetemp").classList.add("fade-out-menu");
      delay(1000).then(() => {
        document.getElementById("fadetemp").remove();
      }).finally(() => {
        document.getElementById('selected-menu').innerHTML = document.getElementById('selected-menu').innerHTML + `
              <div class="menu-selected-item" id="div-`+itemId+`">
                <div class="menu-selected-row">
                  <div class="menu-selected-row-delete"><i class="fas fa-trash-alt" onclick="removeItem(`+itemId+`)"></i></div>
                  <div class="menu-selected-row-image">
                    <img src="`+document.getElementById(imageUrl).src+`">
                  </div>
                  <div class="menu-selected-row-description has-text-left">
                    <h4 class="mb-0 mt-0">`+document.getElementById(itemName).innerHTML+`</h4>
                    <input placeholder="qty" value="1" id="item-qty-`+itemId+`" onchange="updateCartQty(`+itemId+`);">
                  </div>
                  <div class="menu-selected-row-price">
                    <h4 class="mb-0 mt-0" id="item-price-`+itemId+`">`+document.getElementById(ItemPrice).innerHTML+`</h4>
                  </div>
                </div>
              </div>`;
        total = parseFloat(total) + parseFloat(document.getElementById(ItemPrice).innerHTML.replace(/\D/g,''));
        updateTotal(total);
        addToOrder(itemId);
        counter = false;
      });
    }
  }

  function updateTotal(amount){
    document.getElementById('price-tag').innerHTML = amount+'.00';
    document.getElementById('confirmed-total').value = amount;
  }

  function addToOrder(itemId){
    order[itemId] = "1";
    document.getElementById('order-array').value = JSON.stringify(order);
  }

  function updateCartQty(itemId){
    let qtyDiv = 'item-qty-'+itemId;
    let itemPriceDiv = 'price-'+itemId;
    let itemPriceDivCart = 'item-price-'+itemId;
    let increasedQty = order[itemId] - document.getElementById(qtyDiv).value;

    //TODO 
    //convert everything to positive
    let changedAmount = parseInt(document.getElementById(itemPriceDiv).innerHTML.replace(/\D/g,'')) * Math.abs(increasedQty);
    if(increasedQty < 0){
      total = total + changedAmount;
      updateTotal(total);
    }else{
      total = total - changedAmount;
      updateTotal(total);
    }
    order[itemId] = document.getElementById(qtyDiv).value;
    document.getElementById('order-array').value = JSON.stringify(order);

    document.getElementById(itemPriceDivCart).innerHTML = 'LKR ' + (order[itemId] * parseInt(document.getElementById(itemPriceDiv).innerHTML.replace(/\D/g,'')))

    //TODO
    console.log(order);
  }

  function removeCartQty(itemId){
    delete order[itemId];
  }

  function removeItem(itemId){
    let divName = 'div-'+itemId;
    let priceDiv = 'item-price-'+itemId;
    total = parseFloat(document.getElementById('price-tag').innerHTML) - parseFloat(document.getElementById(priceDiv).innerHTML.replace(/\D/g,''));
    removeCartQty(itemId);
    updateTotal(total);
    document.getElementById('order-array').value = JSON.stringify(order);
    let toBeDeleted = document.getElementById(divName);
    toBeDeleted.parentNode.removeChild(toBeDeleted);
  }

</script>
</body>

</html>