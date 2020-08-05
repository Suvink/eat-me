<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- Global Styles -->
  <link rel="stylesheet" href="../../css/style.css" />
  <!-- Local Styles -->
  <link rel="stylesheet" href="../../css/dineinSummeryStyles.css">
  <title>Dine-in Summery</title>
</head>

<body>

  <div class="navbar">
    <div class="columns group">
      <div class="column is-2">
        <img src="../../img/logo.png" height=56 width="224" />
      </div>
      <div class="column is-10 has-text-right nav-logout">
        <i class="fa fa-user" aria-hidden="true"></i>
        <span class="mr-1">Suvin Nimnaka</span>
        <button class="button is-primary">Logout</button>
      </div>
    </div>
  </div>

  <section>
    <div class="columns group">
      <div class="column is-2"></div>
      <div class="column is-8">
        <div class="card">
          <h1 class="orange-color mt-0 mb-1">Order Summery</h1>
          <div class="menu-items">
            <div class="menu-selected-item">
              <div class="menu-selected-row">
                <div class="menu-selected-row-delete"><i class="fas fa-trash-alt"></i></div>
                <div class="menu-selected-row-image">
                  <img src="https://image.flaticon.com/icons/svg/184/184406.svg">
                </div>
                <div class="menu-selected-row-description has-text-left">
                  <h4 class="mb-0 mt-0">Chinese Ramen</h4>
                  <select>
                    <option>Small</option>
                    <option>Regular</option>
                    <option>Large</option>
                  </select>
                </div>
                <div class="menu-selected-row-price">
                  <h4 class="mb-0 mt-0">350.00</h4>
                </div>
              </div>
            </div>
            <div class="menu-selected-item">
              <div class="menu-selected-row">
                <div class="menu-selected-row-delete"><i class="fas fa-trash-alt"></i></div>
                <div class="menu-selected-row-image">
                  <img src="https://image.flaticon.com/icons/svg/184/184406.svg">
                </div>
                <div class="menu-selected-row-description has-text-left">
                  <h4 class="mb-0 mt-0">Chinese Ramen</h4>
                  <select>
                    <option>Small</option>
                    <option>Regular</option>
                    <option>Large</option>
                  </select>
                </div>
                <div class="menu-selected-row-price">
                  <h4 class="mb-0 mt-0">350.00</h4>
                </div>
              </div>
            </div>
          </div>
          <div class="total-box d-flex">
            <div class="title-col">
              <h3 class="mt-1 mb-1">Total Amount</h3>
            </div>
            <div class="price-col has-text-right mr-1">
            <h3 class="mt-1 mb-1">450.00</h3>
            </div>
          </div>
          <div class="row status-badge-orange mt-1">
            <h2>Preparing</h2>
          </div>
          <div class="row status-badge-green mt-1">
            <h2>Served! Enjoy your meal!</h2>
          </div>
          <div class="pay-buttons mt-1">
          <a href=""><button class="button is-link">Review Order</button></a>
            <a href=""><button class="button is-primary">Pay Online</button></a>
            <a href=""><button class="button is-primary">Pay in Cash</button></a>
          </div>
        </div>
      </div>
      <div class="column is-2"></div>
    </div>
  </section>


</body>