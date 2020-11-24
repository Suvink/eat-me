<?php
    require_once './controllers/admin/staffManageController.php';
    $staffManageController =new StaffManageController();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Global Styles -->
    <link rel="stylesheet" href="../css/style.css" />
    <!-- Local Styles -->
    <link rel="stylesheet" href="../css/adminStaffManage.css"  />
    <title>StaffManagement</title>
    <!-- <script type="text/javascript" src="../../js/kitchendisplay.js"></script> -->

</head>

<body>

    <!-- -----navi bar ---------- -->
    <div class="navbar">
        <div class="columns group">
            <div class="column is-2">
                <img src="../../img/logo.png" height=56 width="224" />
            </div>
            <div class="column is-6 ml-5"></div>
            <div class="column is-3 has-text-right nav-logout">
                <i class="fa fa-user" aria-hidden="true"></i>
                <span class="mr-1">ADMIN</span>
                <button class="button is-primary">Logout</button>
            </div>
        </div>
    </div>
    <!--------xx-----navi bar --------xx------->




    <!----------- Main section------------>
    <section>
        <div class="row buttons-row">
            <a href="/inventory">
                <button class="button is-primary right-radius idle" >Inventory</button>

            </a>
            <a href="/grn">
                <button class="button is-primary left-radius right-radius idle">GRN</button>
            </a>
            <a href="/admin/menu/update">
                <button class="button is-primary left-radius right-radius idle">Menue</button>
            </a>
            <a href="/admin/staffmanage">
                <button class="button is-primary  button-is-active  left-radius idle">Staff Manage</button>
            </a>
        </div>
    </section>

    <!--------XX Main Section------------------>

</body>
</html>