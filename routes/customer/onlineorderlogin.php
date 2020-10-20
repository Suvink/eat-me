<?php
require_once "./config/dbconnection.php";
session_start();

$isError = false;

if (isset($_POST['submit'])) {
  $token =  $_REQUEST['token'];
  $otp =  $_REQUEST['otp'];

  $sql = "SELECT * FROM otp_temp WHERE token='$token'";
  $result = $con->query($sql);
  //echo $result->num_rows;
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      if ($token === $row["token"]) {
        $sql = "DELETE FROM otp_temp WHERE token='$token'";
        $result = $con->query($sql);
        $_SESSION['user_phone'] = $row["phone"];
        header('Location: /online');
      } else {
        $isError = true;
      }
    }
  } else {
    $isError = true;
  }
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
  <title>Login - EatME</title>
</head>

<body>
  <div class="navbar">
    <div class="columns group">
      <div class="column is-2">
        <img src="../../img/logo.png" height="56" width="224" />
      </div>
      <div class="column is-10"></div>
    </div>
  </div>

  <div class="container has-text-centered">
    <h1 class="title mb-1 mt-0">Login</h1>
    <img id="banner-image" class="mt-0 mb-0" src="../../img/login.jpg" height="150" />
    <center>
      <div id="error-block"></div>

      <?php
      if ($isError) {
        echo '<div class="row artemis-notification notification-danger bounceIn"><p>Error: Invalid OTP!</p></div>';
      }
      ?>

      <div id="loginInfoDiv" style="display: block">
        <label class="field artemis-input-field">
          <input class="artemis-input" type="text" placeholder="Your Phone Number here" id="phone_number_input" required>
          <span class="label-wrap">
            <span class="label-text">Phone Number</span>
          </span>
        </label>
        <button class="button is-primary" onclick="sendOTP();">Send OTP</button>
      </div>

      <form action="/dinein/login" id="otpDiv" style="display: none" method="POST">
        <label class="field artemis-input-field">
          <input class="artemis-input" type="text" placeholder="Your OTP here" name="otp" autocomplete="one-time-code" required>
          <span class="label-wrap">
            <span class="label-text">OTP</span>
          </span>
        </label>
        <input id="ref_token" style="display: none" name="token">
        <button class="button is-primary" name="submit">Login</button>
      </form>


      </form>
    </center>
  </div>
  <script src="../../plugins/ArtemisAlert/ArtemisAlert.js"></script>
  <script>
    async function sendOTP() {

      let phone_no = document.getElementById('phone_number_input').value;
      if (!/^(?:0|94|\+94|0094)?(?:(11|21|23|24|25|26|27|31|32|33|34|35|36|37|38|41|45|47|51|52|54|55|57|63|65|66|67|81|91)(0|2|3|4|5|7|9)|7(0|1|2|5|6|7|8)\d)\d{6}$/.test(phone_no)) {
        artemisAlert.alert('error', 'Enter a valid phone number!')
        return;
      } else {

        //Call the Loader
        document.getElementById('banner-image').src = '../../img/loading.gif';

        let data = {
          "phone": phone_no,
        }

        try {
          const response = await fetch('/api/v1/verify', {
            method: 'POST',
            body: JSON.stringify(data)
          });

          let dataJson = JSON.parse(await response.text());
          console.log(dataJson);
          if (!dataJson.token) {
            document.getElementById('error-block').innerHTML = '<div class="row artemis-notification notification-danger bounceIn"><p>Error: ' + dataJson.message + '!</p></div>';
            document.getElementById('banner-image').src = '../../img/login.jpg';
          } else {
            document.getElementById('ref_token').value = dataJson.token;
            document.getElementById('banner-image').src = '../../img/login.jpg';
            document.getElementById('loginInfoDiv').style.display = "none";
            document.getElementById('otpDiv').style.display = "block";
          }

        } catch (err) {
          console.log(err.text);
          document.getElementById('banner-image').src = '../../img/login.jpg';
          document.getElementById('error-block').innerHTML = '<div class="row artemis-notification notification-danger bounceIn"><p>Error: Unknown Error Occured! Please try again later!</p></div>';
        }

      }


    }
  </script>

</html>