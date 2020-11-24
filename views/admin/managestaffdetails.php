<?php
 // session_start();
//ob_start();

  

//if(!isset($_SERVER['HTTP_REFERER'])){
 //     header('Location: /staff/details');
 // }
 // if(!isset($_SESSION['user_phone'])){
 //     header('Location: /dinein/login');
 // }

  //require_once './controllers/admin/ManageStaffDetailsController.php';
//Initiate an instance of controller
//$ManageStaffDetailsController = new ManageStaffDetailsController();

//Process the saving of data
//if (isset($_POST['suB'])) {
   // $staffid = $_POST['sid'];
    //$firstname = $_POST['fn'];
   // $lastname = $_POST['ln'];
    //$contactno = $_POST['cno';]
   // $email = $_POST['em'];
   // $roleid =$_POST['rid'];
   // $password = $_POST['pw'];

   // $ManageStaffDetailsController = new ManageStaffDetailsController();
   // $ManageStaffDetailsController->saveData($staffid, $firstname, $lastname, $contactno, $email, $roleid, $password);
//}


?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/png" href="../../img/favicon.png" />
    <!-- Global Styles -->
    <link rel="stylesheet" href="../../css/style.css">
    <!-- Local Styles -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../../css/managestaffdetailsStyles.css">
    <!-- Manifest -->
    <link rel="manifest" href="manifest.webmanifest" />
    <title>Manage Staff Details</title>


  </head>
  <body>
    <!-- Navbar -->
    <div class="navbar">
      <div class="columns group">
        <div class="column is-2">
        <img src="../../img/logo.png" height="56" width="224" alt="Logo image">
        </div>
       </div>
    </div>

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

    
    
               


   

    <script src="js/index.js"></script>
  </body>
</html>
