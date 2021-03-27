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
            $result=$this->StaffManageModel->executeSql(" SELECT * FROM `staff` WHERE tag !='deleted'");
            return $result;
        }
        public function deleteStaff($staffid3)
        {
            $result3=$this->StaffManageModel-> getSpecificDataWhere('status','minor_staff','staffId', $staffid3);
            $row3= mysqli_fetch_assoc($result3);
            $status=$row3['status'];
            if($status=="available")
            {
                $result1=$this->StaffManageModel->deleteData('minor_staff', 'staffId', $staffid3);
                $this->StaffManageModel->updateData('staff','staffId',$staffid3, array('tag' =>"deleted"));
            }
            else
            {
                echo '<script language="javascript">';
                echo 'alert("'.$staffid3.'"+" "+"has already assigned to a work. wait unti the job finish!")';
                echo '</script>';
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
                        if ($roleid < 6 && 0 < $roleid) 
                        {
                            if($password===$re_password)
                            {
                                $val=1;
                            }
                            else
                            {
                                echo '<script language="javascript">';
                                echo 'alert("'.$password.'"+" "+"!="+" "+"'.$re_password.'"+" " +" Passwords are not match")';
                                echo '</script>';
                            }
                        } 
                        else 
                        {
                            echo '<script language="javascript">';
                            echo 'alert("'.$roleid.'"+" "+" Role Id must less than 10")';
                            echo '</script>';
                        }
                    } 
                    else 
                    {
                        echo '<script language="javascript">';
                        echo 'alert("Input contact number size : "+" "+"'.$tpnumbereCount.'"+" "+" contact number must have 10 numbers")';
                        echo '</script>';
                    }
                } 
                else 
                {
                    echo '<script language="javascript">';
                    echo 'alert("'.$cnumber.'"+" "+" contact-number need to be a number")';
                    echo '</script>';
                }
                }
                else
                {
                    echo '<script language="javascript">';
                    echo 'alert("'.$lastname.'"+" "+" Last names need to be a letters and not contains spaces")';
                    echo '</script>';
                }
            }
            else
            {
                echo '<script language="javascript">';
                echo 'alert("'.$firstname.'"+" "+" First names need to be a letters and not contains spaces")';
                echo '</script>';
            }
            return $val;

        }
        public function addStaff($firstname,$lastname,$cnumber,$email,$roleid,$password,$re_password)
        {
            $val2=$this->validation($firstname,$lastname,$cnumber,$email,$roleid,$password,$re_password);
            $password2= MD5($password);
            echo $password2;
            if($val2==1)
            {
                $sqlQ="INSERT INTO `staff`(`firstName`, `lastName`, `contactNo`, `email`, `roleId`, `password`,`tag`) VALUES ('$firstname','$lastname',$cnumber,'$email',$roleid,'$password2','active')";    
                $this->StaffManageModel->executeSql($sqlQ);
                $sqlQ2="SELECT max(staffId) FROM `staff`";
                $newlyAddedID=$this->StaffManageModel->executeSql($sqlQ2);
                $row3 = mysqli_fetch_assoc($newlyAddedID);
                $maxID= $row3['max(staffId)'];
                // echo $roleid;
                if($roleid=="3" || $roleid=="5")
                {
                     $result=$this->StaffManageModel->writeData("minor_staff","staffId,status","$maxID,'available'");
                    
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
                    if($status=="available")
                    {
                        $this->StaffManageModel->updateData('staff','staffId',$staffid, array('firstName' =>$firstname, 'lastName' =>$lastname, 'contactNo' =>$cnumber, 'email' =>$email,'roleId' =>$roleid,'password' =>MD5($password)));
                        
                    }
                    else
                    {
                        echo '<script language="javascript">';
                        echo 'alert("'.$firstname.'"+" "+"has already assigned to a work. wait unti the job finish!")';
                        echo '</script>';
                    }
                }
                else
                {
                    $this->StaffManageModel->updateData('staff','staffId',$staffid, array('firstName' =>$firstname, 'lastName' =>$lastname, 'contactNo' =>$cnumber, 'email' =>$email,'roleId' =>$roleid,'password' =>MD5($password)));
                        
                }

            }
            else
            {
                // echo "invalid data";
            }
            

        }
    }
?>

