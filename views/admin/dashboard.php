<?php
session_start();
ob_start();
$staffid = $_SESSION['staffId'];
$name_first = $_SESSION['firstName'];
$name_last = $_SESSION['lastName'];
$roleId = $_SESSION['roleId'];
require_once './controllers/admin/DashBoardController.php';
$DashBoardController = new DashBoardController();

$result=null;
if (isset($_POST['logout'])) {
  $DashBoardController->logoutstaffMem();
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
  <link rel="stylesheet" href="../../css/adminStyles.css">
  <link rel="stylesheet" href="../../css/adminMenuUpdate.css">
  <title>Admin Dashboard</title>
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
  if ($roleId == "1") {
  ?>
    <section>
      <div class="row buttons-row">
        <a href="/admin">
          <button class="button is-primary button-is-active   right-radius idle">Dash Board</button>
        </a>
        <a href="/inventory">
          <button class="button is-primary right-radius left-radius idle">Inventory</button>

        </a>
        <a href="/grn">
          <button class="button is-primary left-radius right-radius idle">GRN</button>
        </a>
        <a href="/admin/menu/update">
          <button class="button is-primary left-radius right-radius idle">Menue</button>
        </a>
        <a href="/admin/staffmanage">
          <button class="button is-primary left-radius idle">Staff Manage</button>
        </a>
      </div>
    </section>
  <?php
  } else {
    $DashBoardController->logoutstaffMem();
  }
  ?>
  <!-----XX------ navigatable buttons-----XX------->

  <section>
    <div class="columns group">
      <div class="column is-4">
        <div class="card">
          <h4 class="title">
            Ongoing <span class="orange-color">Orders</span>
          </h4>
          <h2 class="subtitle">🕑<?php $result=$DashBoardController->getOngoingOrders(); 
                                      $row = mysqli_fetch_assoc($result);
                                      echo $row['COUNT(*)'];
                                  
                                  ?></h2>
        </div>
      </div>
      <div class="column is-4">
        <div class="card">
          <h4 class="title">
            Completed <span class="orange-color">Orders</span>
          </h4>
          <h2 class="subtitle">🍔<?php $result=$DashBoardController->getCompletedOrders(); 
                                      $row = mysqli_fetch_assoc($result);
                                      echo $row['COUNT(*)'];
                                  ?></h2>
        </div>
      </div>
      <div class="column is-4">
        <div class="card">
          <h4 class="title">
            Inventory <span class="orange-color">Status</span>
          </h4>
          <h2 class="subtitle is-success">✅ OK</h2>
        </div>
      </div>
    </div>
  </section>

  <section class="mt-1 pl-1 pr-1">
    <h1 class="title has-text-centered ">Ongoing <span class="orange-color">Orders</span></h1>
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Customer</th>
          <th>Items</th>
          <th>Price</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
      <?php
        $result = $DashBoardController->getInventoryDetails();
        if($result){
          while ($row = mysqli_fetch_assoc($result))
          {
            ?>
            <tr>

            <td><?php echo $row['customerId']; ?></td>
            <td><?php $result2=$DashBoardController->getCustomerName($row['customerId']); 
                      $row2 = mysqli_fetch_assoc($result2);
                      echo $row2['firstName']." ".$row2['lastName'];
                ?> 
            </td>
            <td><?php $result3=$DashBoardController->getItems($row['orderId']); 
                      while ($row3 = mysqli_fetch_assoc($result3)) 
                      {
                        echo $row3['itemNo'];
                        $result4=$DashBoardController->getItemName($row3['itemNo']); 
                        $row4 = mysqli_fetch_assoc($result4);
                        echo $row4['itemName'];
                      }
                ?> 
            </td>
            <td><?php echo $row['amount']; ?></td>
            <td><?php echo $row['orderStatus']; ?></td> 
            <td><?php $result5=$DashBoardController->getOrderState($row['orderStatus']); 
                      $row5 = mysqli_fetch_assoc($result5);
                      echo $row5['state']; 
                ?> 
            </td>                                    
                                   
            </tr>
            <?php
          }
        }
      ?>
      </tbody>
    </table>
  </section>

</body>

</html>