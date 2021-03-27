<?php
session_start();
ob_start();
$staffid=$_SESSION['staffId'];
$name_first=$_SESSION['firstName'];
$name_last=$_SESSION['lastName'];
$roleId = $_SESSION['roleId'];
require_once './controllers/admin/staffManageController.php';
$staffManageController = new StaffManageController();
// echo $params;


if( isset( $_POST['logout'] ) ){
    $staffManageController->logoutstaffMem();
  }
if( isset( $_POST['delete'] ) ){
    $staffid3=$_POST['staffId'];
    $staffManageController->deleteStaff($staffid3);
  }

if(isset($_POST['submit'])){
    $firstname =$_POST['firstname'];
    $lastname =$_POST['lastname'];
    $cnumber =$_POST['cnumber'];
    $email =$_POST['email'];
    $roleid =$_POST['roleid'];
    $password =$_POST['password'];
    $re_password =$_POST['re_password'];

    $staffManageController->addStaff($firstname,$lastname,$cnumber,$email,$roleid,$password,$re_password);
}
if(isset($_POST['updateStafff'])){
    $staffid=$_POST['staffId'];
    $firstname =$_POST['firstname'];
    $lastname =$_POST['lastname'];
    $cnumber =$_POST['cnumber'];
    $email =$_POST['email'];
    $roleid =$_POST['roleid'];
    $password =$_POST['password'];
    $re_password =$_POST['re_password'];
    if($_SESSION['password2']==$password)
    {
        echo '<script language="javascript">';
        echo 'alert("Need to update the Password")';
        echo '</script>';
    }
    else
    {
        $staffManageController->updateStaff($staffid,$firstname,$lastname,$cnumber,$email,$roleid,$password,$re_password);
    }  
}
$staffid2 ="Taken Automatically";
$firstname2 =null;
$lastName2 =null;
$contactNo2 =null;
$roleId2 =null;
$email2 =null;
$password2=null;
if(isset($_POST['updateToList'])){
    $staffid2 =$_POST['staffId'];
    $firstname2 =$_POST['firstName'];
    $lastName2 =$_POST['lastName'];
    $contactNo2 =$_POST['contactNo'];
    $roleId2 =$_POST['roleId'];
    $email2 =$_POST['email'];
    $password2=$staffManageController->getPassword($staffid2);
    $_SESSION['password2']=$password2;
}
?>
<script src="../../plugins/ArtemisAlert/ArtemisAlert.js"></script>
<script>
    // function triggeralert(msg)
    // {
    //     artemisAlert.alert('success', msg);
    // }
</script>
<?php
    // if(strpos($params,"errormessage")!==false)
    // {
    //     $message=substr($params, strpos($params,'=')+1);
    //     echo "<script type='text/javascript'>triggeralert(".$message.")</script>" ;

    // }
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
    <link rel="stylesheet" href="../../css/kitcheninventory.css">
    <link rel="stylesheet" href="../../css/inventory.css">
    <link rel="stylesheet" href="../../plugins/ArtemisAlert/ArtemisAlert.css">
    <title>StaffManagement</title>
    <!-- <script type="text/javascript" src="../../js/kitchendisplay.js"></script> -->

</head>

<body>

    <!-- -----navi bar ---------- -->
    <form action="" method="POST"> 
        <div class="navbar">
        <div class="columns group">
            <div class="column is-2">
            <img src="../../img/logo.png" height=56 width="224" />
            </div>
            <div class="column is-6 ml-5"></div>
            <div class="column is-3 has-text-right nav-logout">
            <i class="fa fa-user" aria-hidden="true"></i>
            <span class="mr-1"><?php echo $staffid?></span>
            <span class="mr-1"><?php echo $name_first," ",$name_last?></span>
            <button class="button is-primary" name="logout">Logout</button>
            </div>
        </div>
        </div>
    </form>
    <!--------xx-----navi bar --------xx------->
    
    <!----------- navigatable buttons------------>
       <?php
      if($roleId=="1")
      {     
        ?>
            <section>
                <div class="row buttons-row">
                    <a href="/admin">
                            <button class="button is-primary  right-radius idle">Dash Board</button>
                        </a>
                    <a href="/inventory">
                        <button class="button is-primary left-radius right-radius idle">Inventory</button>

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
      <?php
      }
      else
      {
        $staffManageController->logoutstaffMem();
      }
    ?>
<!-----XX------ navigatable buttons-----XX------->




    <!----------- Main section------------>
    
    <section>
        <div class="columns group">
            <div class="column is-8">
                <div class="content table-color mr-0">
                    <table class="inventory-table ">
                        <tr>
                            <th>ID</th>
                            <th>F_Name</th>
                            <th>L_Name</th>
                            <th>Contact Num</th>
                            <th>Email</th>
                            <th>roleId</th>
                            <th>EDIT</th>
                        </tr>
                        <?php
                        $result = $staffManageController->getStaffDetails();
                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                            <tr>
                                <form action="" method="POST">
                                <td><input name="staffId" type="hidden" value="<?php echo $row['staffId']; ?>"><?php echo $row['staffId']; ?></td>
                                <td><input name="firstName" type="hidden" value="<?php echo $row['firstName']; ?>"><?php echo $row['firstName']; ?></td>
                                <td><input name="lastName" type="hidden" value="<?php echo $row['lastName']; ?>"><?php echo $row['lastName']; ?></td>
                                <td><input name="contactNo" type="hidden" value="<?php echo $row['contactNo']; ?>"><?php echo $row['contactNo']; ?></td>
                                <td><input name="email" type="hidden" value="<?php echo $row['email']; ?>"><?php echo $row['email']; ?></td>
                                <td><input name="roleId" type="hidden" value="<?php echo $row['roleId']; ?>"><?php echo $row['roleId']; ?></td>
                                <!-- <td id="stuff"> <button name="updateToList"  value="<?php echo $row['staffId']; ?>" class="visibility-hide zoom">update</button></td> -->
                                <td id="stuff"><button name="updateToList"  value="<?php echo $row['staffId']; ?>" class="visibility-hide zoom" >update</button></td>
                                </form>
                            </tr>
                        <?php
                        }
                        ?>
                    </table>
                </div>
            </div>
        <!-- </div> -->
        <!-- <div class="columns group"> -->
            <div class="column is-4">
                <div class="content ml-0  mt-0 mb-0">
                    <h2>Manage-<span class="change-menu-color">-Staff</span></h2>
                    <div>
                    <form action = '/admin/staffmanage' method = 'POST'>
                        <div class="fill-form">
                            <div class="columns group  mt-0 mb-0">
                                <div class="column is-4  mt-0 mb-0">
                                    <h2> Itam  ID </h2>
                                </div>
                                <div class="column is-6 mt-0 mb-0">
                                    <input class=" zoom" type="hidden"  name="staffId" value="<?php echo $staffid2?>"> 
                                    <h2><span class="change-menu-color"><?php echo $staffid2?></span></h2>
                                </div>
                            </div>
                            <label class="field artemis-input-field ml-2">
                                <input class="artemis-input zoom" type="text" placeholder="Only first name" name="firstname" value="<?php echo $firstname2?>" required>
                                <span class="label-wrap">
                                    <span class="label-text">First Name</span>
                                </span>
                            </label>
                            <label class="field artemis-input-field ml-2">
                                <input class="artemis-input zoom" type="text" placeholder="Onlylast last name" name="lastname" value="<?php echo $lastName2?>" required>
                                <span class="label-wrap">
                                    <span class="label-text">Last Name</span>
                                </span>
                            </label>
                            <label class="field artemis-input-field ml-2">
                                <input class="artemis-input zoom" type="text" placeholder="10 number required" name="cnumber" value="<?php echo "0".$contactNo2?>" required>
                                <span class="label-wrap">
                                    <span class="label-text">Contact NO</span>
                                </span>
                            </label>
                            <label class="field artemis-input-field ml-2">
                                <input class="artemis-input zoom" type="email" placeholder="Sfaff member Email here" name="email" value="<?php echo $email2 ?>" required>
                                <span class="label-wrap">
                                    <span class="label-text">Email</span>
                                </span>
                            </label>
                            <label class="field artemis-input-field ml-2">
                                <input class="artemis-input zoom" type="text" placeholder="Sfaff member role Id" name="roleid" value="<?php echo $roleId2 ?>" required>
                                <span class="label-wrap">
                                    <span class="label-text">Role Id</span>
                                </span>
                            </label>
                            <label class="field artemis-input-field ml-2">
                                <input class="artemis-input zoom" type="text" placeholder="Sfaff member Password here " name="password" value="<?php echo $password2?>" required>
                                <span class="label-wrap">
                                    <span class="label-text">Password</span>
                                </span>
                            </label>
                            <label class="field artemis-input-field ml-2">
                                <input class="artemis-input zoom" type="text" placeholder="Re-Enter password " name="re_password" value="<?php echo $password2?>" required>
                                <span class="label-wrap">
                                    <span class="label-text">Re-Enter Password</span>
                                </span>
                            </label>
                        </div>    
                            <button class="is-primary ml-2 color-green zoom" name="submit">Add</button>
                            <button class="is-primary zoom ml-2" name="updateStafff">Update</button>
                            <button class="is-primary color-red zoom ml-2" name="delete" onclick="return confirm('Are you sure you want to delete the staff Member?');">Delete</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!--------XX Main Section------------------>

</body>

</html>