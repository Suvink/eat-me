<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, intial scale=1.0" /> 
    <!-- Add global styles -->
		<link rel="stylesheet" href="../../css/style.css">
		<!-- local styles -->
		<link rel="stylesheet" href="../../css/deliverypersonStyles.css">
    <title>Delivery Home </title>
  </head>
  <body>
    <div class="navbar">
			<div class="coloumns group">
				<div class="column is-2">
					<img 
						src="../../img/logo.png"
						height="56"
						width="224"					
					/>
				</div>
				<div class="column is-10 has-text-right nav-logout">
					<i class="fas fa-bicycle" aria-hidden="true"></i>
					<span class="mr-1">User Name</span>
					<button class="button is-primary"> Logout </button>
				</div>
			</div>
		</div>
		<div class="coloumns">
				<div class="column is-12">
					<div class="container has-text-centered">
						<div class="card">
							<h1>Set Availability</h1>
							<input type="checkbox" id="switch" class="checkbox"/>
							<label for="switch" class="toggle">
								<p>On &nbsp; &nbsp; Off</p>
							</label>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="coloumns">
				<div class="column is-12">
					<div class="container has-text-centered">
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
												<th>Address</th>
												<th>Status</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>1001</td>
												<td>Mr.MR</td>
												<td>Coca Cola</td>
												<td>LKR 230.00</td>
												<td>Home</td>
												<td>
													<select name="Status" id="Status" onchange="myfunc()">
														<option value="Preparing">Preparing</option>
														<option value="Prepared">Prepared</option>
														<option value="Collected">Collected</option>
														<option value="Delivered" id="del" >Delivered</option>
													</select>
												</td>
											</tr>
										</tbody>
									</table>
							</section>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script>
			function myfunc(){
				var x = document.getElementById("Status").value;
				if(x=="Delivered"){
					alert("Rate customer");
				}
				
			}
		</script>

  </body>
</html>