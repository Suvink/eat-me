<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- Global Styles -->
  <link rel="stylesheet" href="../../css/style.css" />
  <!-- Local Styles -->
  <link rel="stylesheet" href="../../css/dineInStyles.css">
  <title>Dine-in</title>
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
      <div class="column is-8">
        <div class="tabs">
          <input type="radio" id="tab1" name="tab-control" checked>
          <input type="radio" id="tab2" name="tab-control">
          <input type="radio" id="tab3" name="tab-control">
          <input type="radio" id="tab4" name="tab-control">
          <ul>
            <li title="Mains"><label for="tab1" role="button"><i class="fas fa-hamburger mr-1"></i><br><span>Mains</span></label></li>
            <li title="Starters"><label for="tab2" role="button"><i class="fas fa-hotdog mr-1"></i><br><span>Starters</span></label></li>
            <li title="Beverages"><label for="tab3" role="button"><i class="fas fa-beer mr-1"></i><br><span>Beverages</span></label></li>
            <li title="Desserts"><label for="tab4" role="button"><i class="fas fa-cookie mr-1"></i><br><span>Desserts</span></label></li>
          </ul>

          <div class="slider">
            <div class="indicator"></div>
          </div>
          <div class="content">
            <section>
              <h2>Mains</h2>
              <div class="menu-cards">
                <div class="menu-card">
                  <img src="https://image.flaticon.com/icons/svg/1775/1775636.svg">
                  <h3 class="mt-1 mb-0">Chinese Ramen</h3>
                  <h5 class="mt-0">LKR 350.00</h5>
                </div>
                <div class="menu-card">
                  <img src="https://image.flaticon.com/icons/svg/1775/1775636.svg">
                  <h3 class="mt-1 mb-0">Chinese Ramen</h3>
                  <h5 class="mt-0">LKR 350.00</h5>
                </div>
                <div class="menu-card">
                  <img src="https://image.flaticon.com/icons/svg/1775/1775636.svg">
                  <h3 class="mt-1 mb-0">Chinese Ramen</h3>
                  <h5 class="mt-0">LKR 350.00</h5>
                </div>
              </div>

            </section>
            <section>
              <h2>Starters</h2>
              <div class="menu-cards">
                <div class="menu-card">
                  <img src="https://image.flaticon.com/icons/svg/184/184406.svg">
                  <h3 class="mt-1 mb-0">Chicken Burger</h3>
                  <h5 class="mt-0">LKR 350.00</h5>
                </div>
                <div class="menu-card">
                  <img src="https://image.flaticon.com/icons/svg/184/184410.svg">
                  <h3 class="mt-1 mb-0">Kukul Andak</h3>
                  <h5 class="mt-0">LKR 120.00</h5>
                </div>
                <div class="menu-card">
                  <img src="https://image.flaticon.com/icons/svg/1775/1775636.svg">
                  <h3 class="mt-1 mb-0">Chinese Ramen</h3>
                  <h5 class="mt-0">LKR 350.00</h5>
                </div>
              </div>
            </section>
            <section>
              <h2>Beverages</h2>
              Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam nemo ducimus eius, magnam error quisquam sunt voluptate labore, excepturi numquam! Alias libero optio sed harum debitis! Veniam, quia in eum.
            </section>
            <section>
              <h2>Desserts</h2>
              Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa dicta vero rerum? Eaque repudiandae architecto libero reprehenderit aliquam magnam ratione quidem? Nobis doloribus molestiae enim deserunt necessitatibus eaque quidem incidunt.
            </section>
          </div>
        </div>
      </div>
      <div class="column is-4 ml-0 mr-0">
        <div class="card">
          <h1 class="orange-color mt-0 mb-1">Order Summery</h1>

          <div class="menu-selected">
            <div class="menu-selected-item">
              <div class="menu-selected-row">
                <div class="menu-selected-row-delete"><i class="fas fa-trash-alt"></i></div>
                <div class="menu-selected-row-image">
                  <img src="https://image.flaticon.com/icons/svg/1775/1775636.svg">
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

          <button class="button is-primary mt-1">Place Order</button>


        </div>
      </div>
    </div>
  </section>

</body>

</html>