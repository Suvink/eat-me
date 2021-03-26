<?php
session_start();
ob_start();
$staffid = $_SESSION['staffId'];
$name_first = $_SESSION['firstName'];
$name_last = $_SESSION['lastName'];
$roleId = $_SESSION['roleId'];
require_once './controllers/admin/DashBoardController.php';
$DashBoardController = new DashBoardController();

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
  if ($roleId=="1") {
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
          <h2 class="subtitle">🕑 45</h2>
        </div>
      </div>
      <div class="column is-4">
        <div class="card">
          <h4 class="title">
            Completed <span class="orange-color">Orders</span>
          </h4>
          <h2 class="subtitle">🍔 45</h2>
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
        <tr>
          <td>1001</td>
          <td>Thilina</td>
          <td>Coca Cola</td>
          <td>LKR 230.00</td>
          <td>Ongoing</td>
        </tr>
        <tr>
          <td>1001</td>
          <td>Nuwanmali</td>
          <td>Coca Cola</td>
          <td>LKR 230.00</td>
          <td>Ongoing</td>
        </tr>
      </tbody>
    </table>
  </section>



  <section class="mt-2 pl-1 pr-1">
    <h1 class="title has-text-centered ">Inventory <span class="orange-color">Items</span></h1>
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
        <tr>
          <td>1001</td>
          <td>Hasa</td>
          <td>Coca Cola</td>
          <td>LKR 230.00</td>
          <td>Ongoing</td>
        </tr>
        <tr>
          <td>1001</td>
          <td>Amod</td>
          <td>Coca Cola</td>
          <td>LKR 230.00</td>
          <td>Ongoing</td>
        </tr>
      </tbody>
    </table>
  </section>
</body>

</html>