<?php
session_start();
ob_start();


require_once './controllers/admin/RatingsReportController.php';
$RatingsReportController = new RatingsReportController();


$repName = $_SESSION['reportName'];
if (isset($_POST['back'])) {
    header('Location: ./inventory');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Global Styles -->
    <link rel="stylesheet" href="../../css/style.css" />
    <!-- Local Styles -->
    <link rel="stylesheet" href="../../css/grnReport.css">
    <link rel="stylesheet" href="../../css/adminStyles.css">
    <link rel="stylesheet" href="../../css/adminMenuUpdate.css">
    <link rel="stylesheet" href="css/index.css" />
    <title>Report</title>
</head>

<body>

    <section>
        <form action="" method="POST">
            <div class="columns group">
                <div class="column is-2 font">
                    <button name="back" class="zoom" style="background-color:#b41d09" >Back</button>
                </div>
                <div class="column is-10 font">
                </div>
            </div>
        </form>
    </section>

    <section class="mt-1 pl-1 pr-1">
        <h1 class="title has-text-centered ">Customer Ratings <span class="orange-color">REPORTS</span></h1>
        <table id="myTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Order ID</th>
                    <th>Rating Points</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = $RatingsReportController->getRatingDetails();
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                    <tr>
                        <form action="" method="POST">
                            <td style="text-align: center;width:80px;"><?php echo $cusId=$RatingsReportController->getCustomerId($row['orderId']); ?></td>
                            <td  style="text-align: center;width:200px;"><?php echo $RatingsReportController->getCustomerName($cusId); ?></td>
                            <td  style="text-align: center;width:80px;"><?php echo $row['orderId']?></td>
                            <td  style="text-align: center;width:80px;" ><?php echo $row['orderRating']; ?></td>
                            <td  style="text-align: center;" ><?php echo $row['description']; ?></td>
                        </form>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </section>
    <section>
        <div class="columns group">
            <div class="column is-4 font">
                <button class="zoom" style="width:400px;font-family: 'Baloo Thambi 2', cursive;"onclick="sortTableNumbers(0)">Sort by Customer ID</button>
            </div>
            <div class="column is-4 font">
                <button class="zoom" style="width:400px;font-family: 'Baloo Thambi 2', cursive;"  onclick="sortTableLetters(1)">Sort by Customer Name</button>
            </div>
            <div class="column is-4 font">
                <button  class="zoom" style="width:400px;font-family: 'Baloo Thambi 2', cursive;" onclick="sortTableFloat(2)">Sort by Order ID</button>
            </div>
        </div>
    </section>

    <!---------Foter part ----------->
    <section>
      <div class="row footer">
        <div class="columns group">
          <div class="column is-1"></div>
          <div class="column is-3 has-text-centered">
            <h3><b>Order Now</b></h3>
            <ul class="footer-ul">
              <li>Dine In Menu</li>
              <li>Take Away Menu</li>
              <li>Delivery Menu</li>
            </ul>
          </div>
          <div class="column is-3 has-text-centered">
            <h3><b>Social Media</b></h3>
            <ul class="footer-ul">
              <li><i class="fab fa-facebook-f"></i> Facebook</li>
              <li><i class="fab fa-whatsapp"></i> Whatsapp</li>
              <li><i class="fab fa-twitter"></i> Twitter</li>
            </ul>
          </div>
          <div class="column is-4 has-text-centered">
            <h3><b>Contact Us</b></h3>
            <ul class="footer-ul">
              <li>+ 94 777 128 123</li>
              <li>info@eat-me.live</li>
              <li>34, Temple Road, Kandana</li>
            </ul>
          </div>
          <div class="column is-1"></div>
        </div>
        <div class="row has-text-centered pb-1">
          <h5>Made with ♥️  by IS14</h5>
        </div>
      </div>
    </section>
    <!----XX-----Foter part -----XX------>

</body>

<!-- sorting part js file -->
<script src="../../js/reportsort.js"></script>

</html>