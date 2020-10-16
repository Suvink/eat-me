<?php
require_once "./config/dbconnection.php";

//Fetch User data and render NavBar
$renderNavBar = function ($user_phone) use($con){
    $sql = "SELECT * FROM customer WHERE contactNo='".$user_phone."'";
    $result =  $con->query($sql);

    if ($con->query($sql) === FALSE) {
      echo "EatME User 404";
    } else {
        
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          //Trim to first name of provisioned users because the system generated usernames are too long
          if($row['profileType'] == 'PROVISIONED'){
            echo '<span class="mr-1">'.$row['firstName'].'</span>';
          }else{
            echo '<span class="mr-1">'.$row['firstName'].' '.$row['lastName'].'</span>';
          }
        }
      }
  }
};

$renderMainMenu = function () use($con){
  $mainQuery = "SELECT * FROM menu WHERE type='mains'";
  $result =  $con->query($mainQuery);

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      echo '
      <div class="menu-card" id="menu-'.$row['itemNo'].'" onclick="addToCart('.$row['itemNo'].')">
        <div class="menu-card-content">
          <img id="item-picture-'.$row['itemNo'].'" src="https://image.flaticon.com/icons/svg/1775/1775636.svg">
          <h3 id="name-'.$row['itemNo'].'" class="mt-1 mb-0">'.$row['itemName'].'</h3>
          <h5 id="price-'.$row['itemNo'].'" class="mt-0">LKR '.$row['price'].'</h5>
        </div>
      </div>
      ';
    }
  }
};

$renderSidesMenu = function () use($con){
  $sidesQuery = "SELECT * FROM menu WHERE type='starters'";
  $result =  $con->query($sidesQuery);

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      echo '
      <div class="menu-card" id="menu-'.$row['itemNo'].'" onclick="addToCart('.$row['itemNo'].')">
        <div class="menu-card-content">
          <img id="item-picture-'.$row['itemNo'].'" src="https://www.flaticon.com/svg/static/icons/svg/1046/1046786.svg">
          <h3 id="name-'.$row['itemNo'].'" class="mt-1 mb-0">'.$row['itemName'].'</h3>
          <h5 id="price-'.$row['itemNo'].'" class="mt-0">LKR '.$row['price'].'</h5>
        </div>
      </div>
      ';
    }
  }
};

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

//Logout script
if ( isset( $_POST['logout'] ) ){
  session_destroy();
  unset($_SESSION['user_phone']);
  header("Location: /dinein",TRUE,302);
}


?>