<?php
require_once './controllers/admin/staffManageController.php';
$staffManageController = new StaffManageController();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Global Styles -->
    <link rel="stylesheet" href="../css/style.css" />
    <!-- Local Styles -->
    <link rel="stylesheet" href="../css/adminStaffManage.css" />
    <link rel="stylesheet" href="../../css/managestaffdetailsStyles.css">
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
                <button class="button is-primary right-radius idle">Inventory</button>

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
    <section>
        <!--Staff_details_form-->
        <div class="card">
            <div class="staffdetails_form">

                <h1 class="title mb-0" align="center">Staff Details</h1>

                <table class="staffdetails_table" border=0 cellpadding="15px" cellspacing="2px" align="center">

                    <form method="POST" action="DBConnection.php">

                        <tr>
                            <td>Staff ID</td>
                            <td colspan="2"><input type="text" name="sid" class="text_box" placeholder="Enter the Staff ID" size="40px"></td>
                        </tr>
                        <tr>
                            <td>First Name</td>
                            <td colspan="2"><input type="text" name="fn" class="text_box" placeholder="Enter the First Name" size="40px"></td>
                        </tr>
                        <tr>
                            <td>Last Name</td>
                            <td colspan="2"><input type="text" name="ln" class="text_box" placeholder="Enter the Last Name" size="40px"></td>
                        </tr>
                        <tr>
                            <td>Contact Number</td>
                            <td colspan="2"><input type="text" name="cno" class="text_box" placeholder="Enter the Contact Number" size="40px"></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td colspan="2"><input type="text" name="em" class="text_box" placeholder="Enter the Email Address" size="40px"></td>
                        </tr>
                        <tr>
                            <td>Role ID</td>
                            <td colspan="2"><input type="text" name="rid" class="text_box" placeholder="Enter the Role ID" size="40px"></td>
                        </tr>
                        <tr>
                            <td>Password</td>
                            <td colspan="2"><input type="password" name="pw" class="text_box" placeholder="Enter the Password" size="40px"></td>
                        </tr>
                        <tr>
                            <td colspan="1" align="middle"><input type="submit" id="btn" name="suB" value="SAVE"></td>
                            <td colspan="1" align="middle"><input type="submit" id="btn" name="cancelB" value="CANCEL"></td>
                        </tr>
                        <tr>
                            <td colspan="1" align="middle"><input type="submit" id="btn" name="updateB" value="UPDATE"></td>
                            <td colspan="1" align="middle"><input type="submit" id="btn" name="deleteB" value="DELETE"></td>
                        </tr>
                    </form>
                </table>
            </div>
        </div>
    </section>


    <!--------XX Main Section------------------>

</body>

</html>