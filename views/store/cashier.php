<?php
require_once './controllers/store/CashierController.php';
$CashierController = new CashierController();
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, intial scale=1.0" />
	<!-- Add global styles -->
	<link rel="stylesheet" href="../../css/style.css">
	<!-- local styles -->
	<link rel="stylesheet" href="../../css/cashierStyles.css">
	<title>Cashier Dashboard </title>
</head>

<body>
	<div class="navbar" id="popup-background-1">
		<div class="coloumns group">
			<div class="column is-2">
				<img src="../../img/logo.png" height="56" width="224" />
			</div>
			<div class="column is-10 has-text-right nav-logout">
				<i class="fas fa-bicycle" aria-hidden="true"></i>
				<span class="mr-1">User Name</span>
				<button class="button is-primary"> Logout </button>
			</div>
		</div>
	</div>
	<div class="d-flex" id="popup-background-2">
		<button class="button is-primary is-2 mr-1" onclick="checkOrder()"> Check Orders </button>
		<button class="button is-primary is-2 mr-1" onclick="placeOrder()"> Place Order </button>

	</div>
	<div class="coloumns">
		<div class="column is-12">
			<div class="container has-text-centered">
				<div class="card" id="popup-background-3">

					<h1 class="title"> <span class="orange-color">Ongoing</span> Orders </h1>

					<section>

						<button class="card d-inlineblock table-hover transparent-button mr-3" onclick="showTableDetails(1)" id="table-01">
							<h2>Table 01</h2>
						</button>
						<button class="card d-inlineblock table-hover transparent-button mr-3" onclick="showTableDetails(2)" id="table-02">
							<h2>Table 02</h2>
						</button>
						<button class="card d-inlineblock table-hover transparent-button mr-3" onclick="showTableDetails(3)" id="table-03">
							<h2>Table 03</h2>
						</button>
						<button class="card d-inlineblock table-hover transparent-button mr-3" onclick="showTableDetails(4)" id="table-04">
							<h2>Table 04</h2>
						</button>
						<button class="card d-inlineblock table-hover transparent-button mr-3" onclick="showTableDetails(5)" id="table-05">
							<h2>Table 05</h2>
						</button>
						<button class="card d-inlineblock table-hover transparent-button mr-3" onclick="showTableDetails(6)" id="table-06">
							<h2>Table 06</h2>
						</button>
						<button class="card d-inlineblock table-hover transparent-button mr-3" onclick="showTableDetails(7)" id="table-07">
							<h2>Table 07</h2>
						</button>
						<button class="card d-inlineblock table-hover transparent-button mr-3" onclick="showTableDetails(8)" id="table-08">
							<h2>Table 08</h2>
						</button>
					</section>

					<section class="mt-1 pl-1 pr-1">
						<table id="ongoing-orders-table">
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
								<tr>
									<td>1001</td>
									<td>Mr.MR</td>
									<td>Coca Cola</td>
									<td>LKR 230.00</td>
									<td>08</td>
									<td> Preparing</td>
								</tr>

							</tbody>
						</table>
						<button class="button is-primary" onclick="updateTable()">Refresh</button>
					</section>
				</div>
				<?php

				for ($count = 1; $count <= 8; $count++) { ?>
					<section id="section-<?= $count ?>">
						<div class="invisible-box" id="table-description">
							<div class="box-content">
								<span class="close" onclick="closeDetails(<?= $count ?>)">&times;</span>
								<input type="text" name="table-number" style="display: none;" id="save-table-number">
								<button class="button is-success" id="set-reserve" onclick="reserveTable()">
									<?php
									echo $CashierController->renderTableReservationDetails($count) ?></button>
								<table>
									<tr>
										<td>1001</td>
									</tr>
									<tr>
										<td>Mr.Bean</td>
									</tr>
									<tr>
										<td>Order Status </td>
									</tr>
								</table>
							</div>
						</div>
					</section>
				<?php }

				?>
			</div>
		</div>
	</div>
	<script>
		let closeBtn = document.getElementsByClassName("close");
		let tableDescription = document.getElementById("table-description");

		function updateTable() {
			let table = document.getElementById("ongoing-orders-table").getElementsByTagName('tbody')[0];
			let row = table.insertRow(0);

			let id = row.insertCell(0);
			let customer = row.insertCell(1);
			let items = row.insertCell(2);
			let price = row.insertCell(3);
			let table_No = row.insertCell(4);
			let status = row.insertCell(5);

			id.innerHTML = "1007";
			customer.innerHTML = "Mr. T";
			items.innerHTML = "Coke";
			price.innerHTML = "rs.255";
			table_No.innerHTML = "08";
			status.innerHTML = "Preparing";
		}

		function placeOrder() {
			window.location.href = '/cashier/placeorder';
		}

		function checkOrder() {
			window.location.href = '/cashier/checkorders';
		}

		function showTableDetails(tableNumber) {

		//	tableDescription.style.display = "block";
			const tableNo = tableNumber;
			const table  = document.querySelector("#section-" + tableNumber + " #table-description");
			// console.log(table);
			table.style.display = "block";
			// document.getElementById('save-table-number').value = tableNumber;
			blurBackground();
		}

		function closeDetails(tableNumber) {
			const table  = document.querySelector("#section-" + tableNumber + " #table-description");
			table.style.display = "none";
			removeBlur();
		}

		function blurBackground() {
			let blurEliment = document.getElementById("popup-background-1");
			blurEliment.classList.toggle("blur");
			let blurEliment2 = document.getElementById("popup-background-2");
			blurEliment2.classList.toggle("blur");
			let blurEliment3 = document.getElementById("popup-background-3");
			blurEliment3.classList.toggle("blur");
		}

		function removeBlur() {
			let blurEliment = document.getElementById("popup-background-1");
			blurEliment.classList.remove("blur");
			let blurEliment2 = document.getElementById("popup-background-2");
			blurEliment2.classList.remove("blur");
			let blurEliment3 = document.getElementById("popup-background-3");
			blurEliment3.classList.remove("blur");
		}

		function reserveTable() {
			let tableNumber = document.getElementById('table-01');
			tableNumber.classList.toggle("reserved");
			let setButton = document.getElementById("set-reserve");
			setButton.classList.toggle("reserved");
			if (setButton.innerHTML == "Reserved") {
				setButton.innerHTML = "Not Reserved";
			} else {
				setButton.innerHTML = "Reserved";
			}

		}
	</script>

</body>



</html>