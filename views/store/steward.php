<?php
session_start();
ob_start();

require_once "./controllers/store/StewardController.php";
$StewardController = new StewardController();

if (!isset($_SESSION['staffId'])) {
	header('Location: /staff/login');
}

if (isset($_POST['logout'])) {
	$StewardController->logoutstaffMem();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, intial scale=1.0" />
	<!-- Add global styles -->
	<link rel="stylesheet" href="../../css/style.css">
	<!-- local styles -->
	<link rel="stylesheet" href="../../css/stewardStyles.css">
	<link rel="stylesheet" href="../../css/ratingStyles.css">
	<title>Steward Home </title>
</head>

<body>
	<div class="navbar">
		<div class="coloumns group">
			<div class="column is-2">
				<img src="../../img/logo.png" height="56" width="224" />
			</div>
			<div class="column is-10 has-text-right nav-logout">
				<i class="fas fa-user" aria-hidden="true"></i>
				<span class="mr-1">Steward <?= $_SESSION['staffId'] ?></span>
				<form class="d-inline" action="/steward" method="POST">
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
					<form action="" method="POST" name="avalability-switch">
						<input type="checkbox" id="switch" class="checkbox" onclick="changeAvailability()" />
						<input style="display: none;" id="staff" />
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
						<table>
							<thead>
								<tr>
									<th>ID</th>
									<th>Customer</th>
									<th>Items</th>
									<th>Price</th>
									<th>Table No</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody>
								<?php $StewardController->renderAssignedOrders() ?>
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

							<button class="" id="star_1" onclick="colorButton(1)"><i class="far fa-star"><br> Worse</i></button>
							<button class="" id="star_2" onclick="colorButton(2)"><i class="far fa-star"><br>Bad</i></button>
							<button class="" id="star_3" onclick="colorButton(3)"><i class="far fa-star"><br> Average</i></button>
							<button class="" id="star_4" onclick="colorButton(4)"><i class="far fa-star"><br> Good</i></button>
							<button class="" id="star_5" onclick="colorButton(5)"><i class="far fa-star"><br> Great</i></button>
						</div>
						<div class="d-flex" name="customerRate">
							<form action="">
								<label class="field artemis-input-field">
									<input class="artemis-input" type="text" placeholder="Description Here" name="description">
									<span class="label-wrap">
										<span class="label-text">Description</span>
									</span>
								</label>
								<button class="button is-primary" name="submit">Submit</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
	<script>
		function popupRate() {
			var x = document.getElementById("Status").value;
			if (x == "Completed") {
				showRating();
				blurBackground();
			}
		}

		function showRating() {
			let showRating = document.getElementById("rate");
			showRating.classList.toggle("show");

		}

		function colorButton(buttonNumber) {
			switch (buttonNumber) {
				case 1:
					document.getElementById("star_1").classList.toggle("filled-color");
					disableButtons();
					break;
				case 2:
					document.getElementById("star_1").classList.toggle("filled-color");
					document.getElementById("star_2").classList.toggle("filled-color");
					disableButtons();
					break;
				case 3:
					document.getElementById("star_1").classList.toggle("filled-color");
					document.getElementById("star_2").classList.toggle("filled-color");
					document.getElementById("star_3").classList.toggle("filled-color");
					disableButtons();
					break;
				case 4:
					document.getElementById("star_1").classList.toggle("filled-color");
					document.getElementById("star_2").classList.toggle("filled-color");
					document.getElementById("star_3").classList.toggle("filled-color");
					document.getElementById("star_4").classList.toggle("filled-color");
					disableButtons();
					break;
				case 5:
					document.getElementById("star_1").classList.toggle("filled-color");
					document.getElementById("star_2").classList.toggle("filled-color");
					document.getElementById("star_3").classList.toggle("filled-color");
					document.getElementById("star_4").classList.toggle("filled-color");
					document.getElementById("star_5").classList.toggle("filled-color");
					disableButtons();
			}
		}

		function disableButtons() {
			document.getElementById("star_1").disabled = true;
			document.getElementById("star_2").disabled = true;
			document.getElementById("star_3").disabled = true;
			document.getElementById("star_4").disabled = true;
			document.getElementById("star_5").disabled = true;
		}

		function blurBackground() {
			let blurEliment = document.getElementById("detailTable");
			blurEliment.classList.toggle("blur");
		}

		function changeAvailability() {

		}

		function availability() {
			document.getElementById("switch").value = getAvailability();
		}

		async function getAvailability(sId) {

			try {
				const response = await fetch('/api/v1/minorStaffAvailability?staff_id=' + sId, {
					method: 'GET',
				});
				let responseData = JSON.parse(await response.text());
				console.log(responseData);

			} catch (err) {
				console.log(err)
				artemisAlert.alert('error', 'Something went wrong!')
			}
		}
		getAvailability(<?= $_SESSION['staffId'] ?>);
		setInterval(function() {
			getAvailability(<?= $_SESSION['staffId'] ?>);
		}, 30000);
	</script>

</body>

</html>