<?php
require_once "./controllers/store/StaffLoginController.php";

if (isset($_POST['submit'])) {
  $userid =  $_REQUEST['user_id'];
  $password =  $_REQUEST['password'];

  $StaffLoginController = new StaffLoginController();
  $StaffLoginController->submitLogin($userid, $password);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" href="../../img/favicon.png" />
  <!-- Global Styles -->
  <link rel="stylesheet" href="../../css/style.css" />
  <link rel="stylesheet" href="../../plugins/ArtemisAlert/ArtemisAlert.css">
  <title>Staff Login</title>
</head>

<body>
  <div class="navbar">
    <div class="columns group">
      <div class="column is-2">
        <a href="/" ><img src="../../img/logo.png" height="56" width="224" /></a>
      </div>
      <div class="column is-10"></div>
    </div>
  </div>

  <div class="container has-text-centered">
    <h1 class="title mb-1 mt-0">Login</h1>
    <img id="banner-image" class="mt-0 mb-0" src="../../img/login.jpg" height="150" />
    <center>
      <div id="error-block"></div>

    <form action="/staff/login" method='POST'>
      <div id="loginInfoDiv" style="display: block">
        <label class="field artemis-input-field">
          <input class="artemis-input" type="text" placeholder="Your User ID" name="user_id" required>
          <span class="label-wrap">
            <span class="label-text">User ID</span>
          </span>
        </label>
        <label class="field artemis-input-field">
          <input class="artemis-input" type="password" placeholder="Your Password" name="password" required>
          <span class="label-wrap">
            <span class="label-text">Password</span>
          </span>
        </label>
        <button class="button is-primary" type="submit" name="submit">Login</button>
      </div>
    </form>
    </center>
  </div>
  <script src="../../plugins/ArtemisAlert/ArtemisAlert.js"></script>
  <?php
  if (isset($_GET['attempt'])) {
    if ($_GET['attempt'] == 'false') {
      echo "<script> artemisAlert.alert('error', 'login failed')</script>";
    }
  }
  ?>

</html>