<?php
session_start();
ob_start();

require_once "./controllers/store/DeliveryPersonController.php";
$DeliveryPersonController = new DeliveryPersonController();

if (!isset($_SESSION['staffId'])) {
	header('Location: /staff/login');
}


if (isset($_POST['logout'])) {
	$DeliveryPersonController->logoutstaffMem();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, intial scale=1.0" />
	<!-- Add global styles -->
	<link rel="stylesheet" href="../../plugins/ArtemisAlert/ArtemisAlert.css">
	<link rel="stylesheet" href="../../css/style.css">
	<!-- local styles -->
	<link rel="stylesheet" href="../../css/minorStaffStyles.css">
	<link rel="stylesheet" href="../../css/deliveryPersonStyles.css">
	<link rel="stylesheet" href="../../css/ratingStyles.css">
  <link rel="icon" type="image/png" href="../../img/favicon.png" />
	<title>Delivery Home </title>
</head>

<body>
	<div class="navbar">
		<div class="coloumns group">
			<div class="column is-2">
				<img src="../../img/logo.png" height="56" width="224" />
			</div>
			<div class="column is-10 has-text-right nav-logout">
				<i class="fas fa-user" aria-hidden="true"></i>
				<span class="mr-1">DP <?= $_SESSION['staffId'] ?></span>
				<form class="d-inline" action="/deliveryperson" method="POST">
					<button class="button is-primary" name="logout">Logout</button>
				</form>
			</div>
		</div>
	</div>
	<div class="coloumns">
		<div class="column is-12">
			<div class="container has-text-centered">
				<div class="card" id="availability">
					<h1>Set Availability</h1>
					<input style="display: none;" id="staff" />
					<form action="" method="POST" name="avalability-switch">
						<input type="checkbox" id="switch" class="checkbox" onclick="changeAvailability(<?= $_SESSION['staffId'] ?>)" />
						<label for="switch" class="toggle">
							<p>On &nbsp; &nbsp; Off</p>
						</label>
					</form>
				</div>
			</div>
		</div>
	</div>
	</div>
	<div class="coloumns">
		<div class="column is-12">
			<div class="container has-text-centered" id="detailTable">
				<div class="card">
					<h1 class="title"> <span class="orange-color">Order</span> Details </h1>
					<section class="mt-1 pl-1 pr-1">
						<table id="assigned-order">
							<thead>
								<tr>
									<th>Order ID</th>
									<th>Customer</th>
									<th>Price</th>
									<th>Address</th>
									<th>Status</th>
									<th style="display: none;">CustomerId</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<p id="loading-details" style="display: block;">Loading...</p>
								</tr>
							</tbody>
						</table>
					</section>
				</div>
			</div>
			<div class="popup">
				<div class="popuptext">
					<div class="flex-container" id="rate">
						<h1 class="title">Rate Customer</h1>
						<div class="d-flex" name="customerRate">
							<button class="rate-button" id="star_1" onclick="colorBtnAndRate(1)"><i class="far fa-star"><br> Worse</i></button>
							<button class="rate-button" id="star_2" onclick="colorBtnAndRate(2)"><i class="far fa-star"><br>Bad</i></button>
							<button class="rate-button" id="star_3" onclick="colorBtnAndRate(3)"><i class="far fa-star"><br> Average</i></button>
							<button class="rate-button" id="star_4" onclick="colorBtnAndRate(4)"><i class="far fa-star"><br> Good</i></button>
							<button class="rate-button" id="star_5" onclick="colorBtnAndRate(5)"><i class="far fa-star"><br> Great</i></button>
						</div>
						<div class="d-flex" name="customerRate">
							<form action="">
								<button class="button is-primary" name="submit">Submit</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
	<script src="../../js/store/deliveryperson.js" type="text/javascript"></script>
	<script src="../../plugins/ArtemisAlert/ArtemisAlert.js" type="text/javascript"></script>
	<script>
		//save value of availability input tag
		document.getElementById("switch").value = getAvailability(<?= $_SESSION['staffId'] ?>);
		// //refresh availability data in 30s
		setInterval(function() {
			//console.log(document.getElementById("switch").value);
			getAvailability(<?= $_SESSION['staffId'] ?>);
			getAssignedOrders(<?= $_SESSION['staffId'] ?>);
		}, 5000);
		window.onload = function() {
			getAssignedOrders(<?= $_SESSION['staffId'] ?>);
		}
	</script>
	<!-- <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
	<script>
		window.OneSignal = window.OneSignal || [];
		OneSignal.push(function() {
			OneSignal.init({
				appId: "950f0adf-2de5-4613-a7b0-8790f3104caa",
				safari_web_id: 'web.onesignal.auto.20cc36d3-e742-47b9-8fc8-37c27a32926f'
			});
		});
	</script> -->
	

</body>

</html>