<?php
    require_once './core/Controller.php';
    class StaffManageController extends Controller
    {
        public function __construct()
        {
            require './models/admin/StaffManageModel.php';
            $this->StaffManageModel =new StaffManageModel();
        }
        public function getStaffDetails()
        {
            $result=$this->StaffManageModel->executeSql(" SELECT * FROM `staff` WHERE tag !='DELETED'");
            return $result;
        }
        public function needToProvideNewpassowrd()
        {
                echo "<h1 style='display:none'></h1>";
                echo "<script src='../../plugins/ArtemisAlert/ArtemisAlert.js'></script>";
                echo '<script> artemisAlert.alert("warning", "Need to provide New Password") </script>';
                return;
        }
        public function getRoleName($id)
        {
            $result=$this->StaffManageModel->executeSql(" SELECT roleName FROM `staff_roles` WHERE roleId =$id");
            $row3= mysqli_fetch_assoc($result);
            $name=$row3['roleName'];
            return $name;
        }
        public function deleteStaff($staffid3)
        {
            $result3=$this->StaffManageModel-> getSpecificDataWhere('status','minor_staff','staffId', $staffid3);
            $row3= mysqli_fetch_assoc($result3);
            $status=$row3['status'];
            if(($status=="NOTAVAILABLE"))
            {
                echo "<h1 style='display:none'></h1>";
                echo "<script src='../../plugins/ArtemisAlert/ArtemisAlert.js'></script>";
                echo '<script> artemisAlert.alert("error", "'.$staffid3.'"+" "+"has already assigned to a work. wait unti the job finish!") </script>';
                return;
            }
            else
            {
                $result1=$this->StaffManageModel->deleteData('minor_staff', 'staffId', $staffid3);
                $this->StaffManageModel->updateData('staff','staffId',$staffid3, array('tag' =>"DELETED"));
                echo "<h1 style='display:none'></h1>";
                echo "<script src='../../plugins/ArtemisAlert/ArtemisAlert.js'></script>";
                echo '<script> artemisAlert.alert("success", "'.$staffid3.'"+" "+"has deleted from the staff") </script>';
                return;
            }
        }
        public function getPassword($staffid2)
        {
            $result=$this->StaffManageModel-> getSpecificDataWhere('password','staff','staffId', $staffid2);
            $row= mysqli_fetch_assoc($result);
            $password=$row['password'];
            return $password;
        }
        public function validation($firstname,$lastname,$cnumber,$email,$roleid,$password,$re_password)
        {
            $tpnumbereCount= preg_match_all( "/[0-9]/", $cnumber );
            $val=0;
            if(ctype_alpha($firstname))
            {
                if(ctype_alpha($lastname))
                {
                if (ctype_digit($cnumber)) 
                {
                    if ($tpnumbereCount == 10) 
                    {
                        if ($roleid < 15 && 0 < $roleid) 
                        {
                            if($password===$re_password)
                            {
                                $val=1;
                            }
                            else
                            {
                                echo "<h1 style='display:none'></h1>";
                                echo "<script src='../../plugins/ArtemisAlert/ArtemisAlert.js'></script>";
                                echo '<script> artemisAlert.alert("error", "'.$password.'"+" "+"!="+" "+"'.$re_password.'"+" " +" Passwords are not match") </script>';
                                return;
                            }
                        } 
                        else 
                        {
                            echo "<h1 style='display:none'></h1>";
                            echo "<script src='../../plugins/ArtemisAlert/ArtemisAlert.js'></script>";
                            echo '<script> artemisAlert.alert("error", "Role ID: "+"'.$roleid.'"+" "+"Need to be less than 15") </script>';
                            return;
                        }
                    } 
                    else 
                    {
                      
                        echo "<h1 style='display:none'></h1>";
                        echo "<script src='../../plugins/ArtemisAlert/ArtemisAlert.js'></script>";
                        echo '<script> artemisAlert.alert("error", "Input contact number size : "+" "+"'.$tpnumbereCount.'"+" "+" contact number must include 10 numbers") </script>';
                        return;
                    }
                } 
                else 
                {
        
                    echo "<h1 style='display:none'></h1>";
                    echo "<script src='../../plugins/ArtemisAlert/ArtemisAlert.js'></script>";
                    echo '<script> artemisAlert.alert("error", "'.$cnumber.'"+" "+" contact-number need to be a number") </script>';
                    return;
                }
                }
                else
                {
                   
                    echo "<h1 style='display:none'></h1>";
                    echo "<script src='../../plugins/ArtemisAlert/ArtemisAlert.js'></script>";
                    echo '<script> artemisAlert.alert("error", "'.$lastname.'"+" "+" Last names need to be a letters and not contains spaces") </script>';
                    return;
                }
            }
            else
            {
              
                echo "<h1 style='display:none'></h1>";
                echo "<script src='../../plugins/ArtemisAlert/ArtemisAlert.js'></script>";
                echo '<script> artemisAlert.alert("error", "'.$firstname.'"+" "+" First names need to be a letters and not contains spaces") </script>';
                return;
            }
            return $val;

        }
        public function addStaff($firstname,$lastname,$cnumber,$email,$roleid,$password,$re_password)
        {
            $val2=$this->validation($firstname,$lastname,$cnumber,$email,$roleid,$password,$re_password);
            $password2= MD5($password);
            // echo $password2;
            if($val2==1)
            {
                $sqlQ="INSERT INTO `staff`(`firstName`, `lastName`, `contactNo`, `email`, `roleId`, `password`,`tag`) VALUES ('$firstname','$lastname',$cnumber,'$email',$roleid,'$password2','ACTIVE')";    
                $this->StaffManageModel->executeSql($sqlQ);

                echo "<h1 style='display:none'></h1>";
                echo "<script src='../../plugins/ArtemisAlert/ArtemisAlert.js'></script>";
                echo '<script> artemisAlert.alert("success", "'.$firstname.'"+"  "+"'.$lastname.'"+" Adeed to the staff Sucsessfully!") </script>';
                return;
                

                $sqlQ2="SELECT max(staffId) FROM `staff`";
                $newlyAddedID=$this->StaffManageModel->executeSql($sqlQ2);
                $row3 = mysqli_fetch_assoc($newlyAddedID);
                $maxID= $row3['max(staffId)'];
                // echo $maxID;
                // echo $roleid;
                if($roleid=="3"||$roleid=="5")
                {
                     $result=$this->StaffManageModel->writeData("minor_staff","staffId,status","$maxID,'AVAILABLE'");
                     $_SESSION['one']=null;$_SESSION['two']=null;$_SESSION['three']=null;$_SESSION['four']=null;$_SESSION['five']=null;$_SESSION['six']=null;$_SESSION['seven']=null;
                }

            }
            else
            {
                // echo "invalid data";
            }
            

        }
        public function updateStaff($staffid,$firstname,$lastname,$cnumber,$email,$roleid,$password,$re_password)
        {
            $val2=$this->validation($firstname,$lastname,$cnumber,$email,$roleid,$password,$re_password);
            if($val2==1)
            {  

                $result3=$this->StaffManageModel-> getSpecificDataWhere('status','minor_staff','staffId', $staffid);
                $row3= mysqli_fetch_assoc($result3);
                $status=$row3['status'];
                if($roleid==5 || $roleid==3)
                {
                    if($status=="NOTAVAILABLE")
                    {
                       
                        echo "<h1 style='display:none'></h1>";
                        echo "<script src='../../plugins/ArtemisAlert/ArtemisAlert.js'></script>";
                        echo '<script> artemisAlert.alert("success", "User has already assigned to a work. wait unti the job finish!") </script>';
                        return;
                    }
                    else
                    {
                        echo "<h1 style='display:none'></h1>";
                        echo "<script src='../../plugins/ArtemisAlert/ArtemisAlert.js'></script>";
                        echo '<script> artemisAlert.alert("success", "'.$firstname.'"+" "+"'.$lastname.'"+" Updated Sucsessfully!") </script>';
                        return; 
                    }

                }
                else
                {
                    $this->StaffManageModel->updateData('staff','staffId',$staffid, array('firstName' =>$firstname, 'lastName' =>$lastname, 'contactNo' =>$cnumber, 'email' =>$email,'roleId' =>$roleid,'password' =>MD5($password)));
                    $_SESSION['one']=null;$_SESSION['two']=null;$_SESSION['three']=null;$_SESSION['four']=null;$_SESSION['five']=null;$_SESSION['six']=null;$_SESSION['seven']=null; 
                    echo '<script language="javascript">';
                    echo 'alert("'.$firstname.'"+"  "+"'.$lastname.'"+" Updated Sucsessfully!")';
                    echo '</script>';  
                }

            }
            else
            {
                // echo "invalid data";
            }
            

        }
    }
?>

