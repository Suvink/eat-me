let oIdNo="";
let cusIdNo="";
function popupRate(oId) {
	let x = document.getElementById(oId).value;
	//console.log(x);
	oIdNo=oId.replace("Status_","");
	//console.log(document.getElementById("temp-cus-id-"+oIdNo).value);
	cusIdNo=document.getElementById("temp-cus-id-"+oIdNo).value;
	//console.log(oIdNo);

	if (x == "Completed") {
		showRating();
		blurBackground();
	}else if (x == "Served") {
		//console.log("Served");
		updateOrderStatus();
	}
}
async function updateOrderStatus() {
	try {
		const response = await fetch('/api/v1/steward/UpdateServed?update=true&order_id='+oIdNo, {
			method: 'GET',
		});
		let responseOrderData = JSON.parse(await response.text());
		//console.log(responseOrderData);
		
		} catch (err) {
			console.log(err)
			artemisAlert.alert('error', 'Something went wrong!')
		}
	}

function showRating() {
	let showRating = document.getElementById("rate");
	showRating.classList.toggle("show");

}

function colorBtnAndRate(buttonNumber) {
	console.log(buttonNumber);
	switch (buttonNumber) {
		case 1:
			clearButtons();
			document.getElementById("star_1").classList.toggle("filled-color");
			disableButtons();
			break;
		case 2:
			clearButtons();
			document.getElementById("star_1").classList.toggle("filled-color");
			document.getElementById("star_2").classList.toggle("filled-color");
			disableButtons();
			break;
		case 3:
			clearButtons();
			document.getElementById("star_1").classList.toggle("filled-color");
			document.getElementById("star_2").classList.toggle("filled-color");
			document.getElementById("star_3").classList.toggle("filled-color");
			disableButtons();
			break;
		case 4:
			clearButtons();
			document.getElementById("star_1").classList.toggle("filled-color");
			document.getElementById("star_2").classList.toggle("filled-color");
			document.getElementById("star_3").classList.toggle("filled-color");
			document.getElementById("star_4").classList.toggle("filled-color");
			disableButtons();
			break;
		case 5:
			clearButtons();
			document.getElementById("star_1").classList.toggle("filled-color");
			document.getElementById("star_2").classList.toggle("filled-color");
			document.getElementById("star_3").classList.toggle("filled-color");
			document.getElementById("star_4").classList.toggle("filled-color");
			document.getElementById("star_5").classList.toggle("filled-color");
			disableButtons();
		}
	rateCustomer(buttonNumber);
}

function clearButtons() {
	document.getElementById("star_1").classList.remove("filled-color");
	document.getElementById("star_2").classList.remove("filled-color");
	document.getElementById("star_3").classList.remove("filled-color");
	document.getElementById("star_4").classList.remove("filled-color");
	document.getElementById("star_5").classList.remove("filled-color");
}
function disableButtons(){
	document.getElementById("star_1").disabled= true;
	document.getElementById("star_2").disabled= true;
	document.getElementById("star_3").disabled= true;
	document.getElementById("star_4").disabled= true;
	document.getElementById("star_5").disabled= true;
}
function blurBackground() {
	let blurEliment = document.getElementById("detailTable");
	blurEliment.classList.toggle("blur");
}

//take and display assign orders realtime
async function getAssignedOrders(sId) {
	try {
		const response = await fetch('/api/v1/minorStaffOrder?staff_id=' + sId, {
			method: 'GET',
		});
		let responseOrderData = JSON.parse(await response.text());
		//console.log(responseOrderData);
		document.getElementById("loading-details").style.display = "none";
		let tbodyOrderRef = document.getElementById("assigned-order").getElementsByTagName('tbody')[0];

		//Clear the table
		//console.log(tbodyOrderRef.rows.length);
		for (let d = tbodyOrderRef.rows.length - 1; d >= 0; d--) {
			tbodyOrderRef.deleteRow(d);

		}

		//insert order details
		responseOrderData.forEach(function (entry) {
			//console.log(entry);
			
			//filter by order status for the UI
			if (entry.orderStatus == '1' || entry.orderStatus == '2' || entry.orderStatus == '3' || entry.orderStatus == '4' || entry.orderStatus == '5'||entry.orderStatus == '6') {
				let row = tbodyOrderRef.insertRow(0);
				let id = row.insertCell(0);
				let customer = row.insertCell(1);
				let amount = row.insertCell(2);
				let tableNo = row.insertCell(3);
				let status = row.insertCell(4);
				let cusId =row.insertCell(5);

				id.innerHTML = entry.orderId;
				customer.innerHTML = (entry.firstName.includes("user-") ? entry.firstName : (entry.firstName + ' ' + entry.lastName));
				amount.innerHTML = 'Rs.' + entry.amount + '.00';
				tableNo.innerHTML = entry.tableNo;
				status.innerHTML = `<select name="Status" id="Status_` + entry.orderId + `" onchange=popupRate("Status_`+ entry.orderId + `")>
                                        <option value="Placed">Placed</option>
                                        <option value="Accepted">Accepted</option>
                                        <option value="Steward_Assigned">Assigned</option>
                                        <option value="Prepared">Prepared</option>
                                        <option value="Served">Served</option>
                                        <option value="Completed">Completed</option>
																		</select>`;
				cusId.id='temp-cus-id-' + entry.orderId;
				cusId.value=entry.customerId;
				document.getElementById("Status_" + entry.orderId).value = returnOrderStatus(entry.orderStatus);
			}
		});
	} catch (err) {
		console.log(err)
		artemisAlert.alert('error', 'Something went wrong!')
	}
}

async function changeAvailability(sId) {
	let switchState = "";
	if (document.getElementById("switch").checked) {
		//if steward is not available right now
		document.getElementById("switch").checked = true;
		switchState = "AVAILABLE";
	} else {
		//if steward is available right now
		document.getElementById("switch").checked = false;
		switchState = "NOTAVAILABLE";
	}
	let jsonObj = {
		"state": switchState,
		"staffId":sId
	}
	
	const response = await fetch('/api/v1/minorStaffAvailability', {
		method: 'POST',
		body: JSON.stringify(jsonObj)
	});

	let responseData = JSON.parse(await response.text());
	//console.log(responseData);
}

async function getAvailability(sId) {

	try {
		const response = await fetch('/api/v1/minorStaffAvailability?staff_id=' + sId, {
			method: 'GET',
		});
		let responseData = JSON.parse(await response.text());
		//console.log(responseData);
		if (responseData.status == 'AVAILABLE') {
			document.getElementById("switch").checked = true;
		} else {
			document.getElementById("switch").checked = false;
		}

	} catch (err) {
		console.log(err)
		artemisAlert.alert('error', 'Something went wrong!')
	}
}
async function rateCustomer(rateNo){
	let rateData={
		"rateNum":rateNo,
		"orderId":oIdNo,
		"cusId": cusIdNo
	}
	try {
		const response = await fetch('/api/v1/minorStaff/RateCustomer', {
			method: 'POST',
			body: JSON.stringify(rateData)
		});
		let responseData = JSON.parse(await response.text());
		//console.log(responseData);

	} catch (err) {
		console.log(err)
		artemisAlert.alert('error', 'Error in updating rating!')
	}
}
function returnOrderStatus(num) {
	switch (num) {
		case '1':
			return 'Placed';
			break;
		case '2':
			return 'Accepted';
			break;
		case '3':
			return 'Steward_Assigned';
			break;
		case '4':
			return 'DP_Assigned';
			break;
		case '5':
			return 'Prepared';
			break;
		case '6':
			return 'Served';
			break;
		case '7':
			return 'Delivered';
			break;
		case '8':
			return 'Completed';
			break;
		case '9':
			return 'Canceled';
			break;
		default:
			return 'False Status';
	}
}