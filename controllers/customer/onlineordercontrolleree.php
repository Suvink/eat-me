<?php

require_once "./config/dbconnection.php";


//Logout script
if ( isset( $_POST['logout'] ) ){
  session_destroy();
  unset($_SESSION['user_phone']);
  header("Location: /online",TRUE,302);
}



$renderBeveragesMenu = function () use($con){
  $beveragesQuery = "SELECT * FROM menu WHERE type='beverages'";
  $result =  $con->query($beveragesQuery);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      echo '
      <div class="menu-card" id="menu-'.$row['itemNo'].'" onclick="addToCart('.$row['itemNo'].')">
        <div class="menu-card-content">
          <img id="item-picture-'.$row['itemNo'].'" src="https://www.flaticon.com/svg/static/icons/svg/1046/1046781.svg">
          <h3 id="name-'.$row['itemNo'].'" class="mt-1 mb-0">'.$row['itemName'].'</h3>
          <h5 id="price-'.$row['itemNo'].'" class="mt-0">LKR '.$row['price'].'</h5>
        </div>
      </div>
      ';
    }
  }
};


$renderDessertMenu = function () use($con){
  $beveragesQuery = "SELECT * FROM menu WHERE type='desserts'";
  $result =  $con->query($beveragesQuery);

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      echo '
      <div class="menu-card" id="menu-'.$row['itemNo'].'" onclick="addToCart('.$row['itemNo'].')">
        <div class="menu-card-content">
          <img id="item-picture-'.$row['itemNo'].'" src="https://www.flaticon.com/svg/static/icons/svg/1046/1046767.svg">
          <h3 id="name-'.$row['itemNo'].'" class="mt-1 mb-0">'.$row['itemName'].'</h3>
          <h5 id="price-'.$row['itemNo'].'" class="mt-0">LKR '.$row['price'].'</h5>
        </div>
      </div>
      ';
    }
  }
};

?>