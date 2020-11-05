<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Global Styles -->
    <link rel="stylesheet" href="../../css/style.css" />
    <!-- Local Styles -->
    <link rel="stylesheet" href="../../css/adminStyles.css">
    <title>Admin Dashboard</title>
  </head>
  <body>
    <div class="navbar">
      <div class="columns group">
        <div class="column is-2">
          <img
            src="../../img/logo.png"
            height=56
            width="224"
          />
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
        <div class="column is-4">
          <div class="card">
            <h4 class="title">
              Ongoing <span class="orange-color">Orders</span>
            </h4>
            <h2 class="subtitle">🕑 45</h2>
          </div>
        </div>
        <div class="column is-4">
          <div class="card">
            <h4 class="title">
              Completed <span class="orange-color">Orders</span>
            </h4>
            <h2 class="subtitle">🍔 45</h2>
          </div>
        </div>
        <div class="column is-4">
          <div class="card">
            <h4 class="title">
              Inventory <span class="orange-color">Status</span>
            </h4>
            <h2 class="subtitle is-success">✅ OK</h2>
          </div>
        </div>
      </div>
    </section>

    <section class="mt-1 pl-1 pr-1">
      <h1 class="title has-text-centered ">Ongoing <span class="orange-color">Orders</span></h1>
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Customer</th>
            <th>Items</th>
            <th>Price</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1001</td>
            <td>Moda Thilina</td>
            <td>Coca Cola</td>
            <td>LKR 230.00</td>
            <td>Ongoing</td>
          </tr>
          <tr>
            <td>1001</td>
            <td>Moda Nuwanmali</td>
            <td>Coca Cola</td>
            <td>LKR 230.00</td>
            <td>Ongoing</td>
          </tr>
        </tbody>
      </table>
    </section>



    <section class="mt-2 pl-1 pr-1">
      <h1 class="title has-text-centered ">Inventory <span class="orange-color">Items</span></h1>
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Customer</th>
            <th>Items</th>
            <th>Price</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1001</td>
            <td>Moda Hasa</td>
            <td>Coca Cola</td>
            <td>LKR 230.00</td>
            <td>Ongoing</td>
          </tr>
          <tr>
            <td>1001</td>
            <td>Moda Amod</td>
            <td>Coca Cola</td>
            <td>LKR 230.00</td>
            <td>Ongoing</td>
          </tr>
        </tbody>
      </table>
    </section>
  </body>
</html>
