function setTableToStorage() {
    let table_number = document.getElementById("table_number_input").value;
    if (table_number !== "" && table_number < 9) {
      localStorage.setItem("table_number", table_number);
      hideSetTableModal();
    } else {
      artemisAlert.alert('warning', 'A Valid table number is required!')
    }
  }

  function placeOrder() {
    window.location.href = '/cashier/placeorder';
  }

  function checkOrder() {
    window.location.href = '/cashier/checkorders';
  }

  function showSetTableModal() {
    const table = document.querySelector("#section-table" + " #settable-description");
    table.style.display = "block";
    blurBackground();
  }

  function hideSetTableModal() {
    const table = document.querySelector("#section-table" + " #settable-description");
    table.style.display = "none";
    blurBackground();
  }

  function showTableDetails(tableNumber) {
    //show table details of table number
    const table = document.querySelector("#section-" + tableNumber + " #table-description");
    // console.log(table);
    table.style.display = "block";
    blurBackground();
  }

  function closeDetails(tableNumber) {
    const table = document.querySelector("#section-" + tableNumber + " #table-description");
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

  async function reserveTable(number) {
    let table = document.querySelector("#table-0" + number);
    let isTableReserved;
    table.classList.toggle("reserved");
    let setButton = document.querySelector("#set-reserve-" + number);
    if (setButton.innerHTML.includes('Not')) {
      setButton.innerHTML = "Reserved";
      isTableReserved = true;
      setButton.classList.toggle("reserved");
    } else {
      setButton.innerHTML = "Not Reserved";
      isTableReserved = false;
      setButton.classList.remove("reserved");
    }

    let data = {
      "table": number,
      "isReserved": isTableReserved
    }

    try {
      const response = await fetch('/api/v1/reserve/table', {
        method: 'POST',
        body: JSON.stringify(data)
      });

      let dataJson = JSON.parse(await response.text());
    } catch (err) {
      artemisAlert.alert('error', 'Something went wrong!')
    }

  }
  //order details table
  async function fetchOrderDetails() {
    try {
      const response = await fetch('/api/v1/ongoingorders', {
        method: 'GET',
      });
      let responseData = JSON.parse(await response.text());
      //console.log(responseData);

      let tbodyRef = document.getElementById("ongoing-orders-table").getElementsByTagName('tbody')[0];

      //Clear the table
      //console.log(tbodyRef.rows.length);
      for (let d = tbodyRef.rows.length - 1; d >= 0; d--) {
        tbodyRef.deleteRow(d);
      }

      //Insert data to table

      responseData.forEach(function(entry) {
        let row = tbodyRef.insertRow(0);
        let id = row.insertCell(0);
        let customer = row.insertCell(1);
        let order_type = row.insertCell(2);
        let amount = row.insertCell(3);
        let status = row.insertCell(4);

        id.innerHTML = entry.orderId;
        customer.innerHTML = (entry.firstName.includes("user-") ? entry.firstName : (entry.firstName + ' ' + entry.lastName));
        order_type.innerHTML = entry.orderType;
        amount.innerHTML = 'Rs.' + entry.amount + '.00';
        status.innerHTML = returnOrderStatus(entry.orderStatus);
      });

    } catch (err) {
      console.log(err)
      artemisAlert.alert('error', 'Something went wrong!')
    }
  }
  //return orderstatus in readable format
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