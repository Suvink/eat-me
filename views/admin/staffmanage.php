<?php
require_once './controllers/admin/staffManageController.php';
$staffManageController = new StaffManageController();

if(isset($_POST['submit'])){
    $staffid =$_POST['staffid'];
    $firstname =$_POST['firstname'];
    $lastname =$_POST['lastname'];
    $cnumber =$_POST['cnumber'];
    $email =$_POST['email'];
    $roleid =$_POST['roleid'];
    $password =$_POST['password'];
 
    $staffManageController->addStaff($staffid,$firstname,$lastname,$cnumber,$email,$roleid,$password);

    unset($_POST['submit']);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Global Styles -->
    <link rel="stylesheet" href="../css/style.css" />
    <!-- Local Styles -->
    <link rel="stylesheet" href="../../css/staffManage.css">
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
        <div class="content">
            <div class="columns group">
                <div class="column is-8">
                    <table class="inventory-table">
                        <tr>
                            <th>ID</th>
                            <th>F_Name</th>
                            <th>L_Name</th>
                            <th>Contact Num</th>
                            <th>Email</th>
                            <th>roleId</th>
                            <th>Password</th>
                        </tr>
                        <?php
                        $result = $staffManageController->getStaffDetails();
                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                            <tr>
                                <td><?php echo $row['staffId']; ?></td>
                                <td><?php echo $row['firstName']; ?></td>
                                <td><?php echo $row['lastName']; ?></td>
                                <td><?php echo $row['contactNo']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php echo $row['roleId']; ?></td>
                                <td><?php echo $row['password']; ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </table>
                </div>
            
                <div class="column is-3">
                    <h2>Manage-<span class="change-menu-color">-Staff</span></h2>
                    <div>
                    <form action = '/admin/staffmanage' method = 'POST'>
                        <div class="fill-form">
                            <label class="field artemis-input-field">
                                <input class="artemis-input" type="text" placeholder="New Staff Id here" name="staffid">
                                <span class="label-wrap">
                                    <span class="label-text">Staff ID</span>
                                </span>
                            </label>
                            <label class="field artemis-input-field">
                                <input class="artemis-input" type="text" placeholder="Sfaff member first Name" name="firstname">
                                <span class="label-wrap">
                                    <span class="label-text">First Name</span>
                                </span>
                            </label>
                            <label class="field artemis-input-field">
                                <input class="artemis-input" type="text" placeholder="Sfaff member last Name" name="lastname">
                                <span class="label-wrap">
                                    <span class="label-text">Last Name</span>
                                </span>
                            </label>
                            <label class="field artemis-input-field">
                                <input class="artemis-input" type="text" placeholder="Sfaff member Contact Number" name="cnumber">
                                <span class="label-wrap">
                                    <span class="label-text">Contact NO</span>
                                </span>
                            </label>
                            <label class="field artemis-input-field">
                                <input class="artemis-input" type="email" placeholder="Sfaff member Email here" name="email">
                                <span class="label-wrap">
                                    <span class="label-text">Email</span>
                                </span>
                            </label>
                            <label class="field artemis-input-field">
                                <input class="artemis-input" type="text" placeholder="Sfaff member role Id" name="roleid">
                                <span class="label-wrap">
                                    <span class="label-text">Role Id</span>
                                </span>
                            </label>
                            <label class="field artemis-input-field">
                                <input class="artemis-input" type="text" placeholder="Sfaff member Password here " name="password">
                                <span class="label-wrap">
                                    <span class="label-text">Password</span>
                                </span>
                            </label>
                        </div>    
                            <button class="is-primary" name="submit">Add</button>
                            <button class="is-primary">Update</button>
                            <button class="is-primary">Delete</button>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>


    <!--------XX Main Section------------------>

</body>

</html>