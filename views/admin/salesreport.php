<?php
session_start();
ob_start();





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
                    <button name="back" class="zoom;" style="background-color:#b41d09;font-family: 'Baloo Thambi 2', cursive;" >Back</button>
                </div>
                <div class="column is-8 font">
                </div>
                <div class="column is-2 font">
                    <button  class="zoom" style="font-family: 'Baloo Thambi 2', cursive;" onclick="window.print();">Print</button>
                </div>
            </div>
        </form>
    </section>

</body>

</html>