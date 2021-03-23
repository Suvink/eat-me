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
            $result=$this->StaffManageModel->getAllData('staff');
            return $result;
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
            if($val2==1)
            {
                    $this->StaffManageModel->writeData("`staff`","`firstName`,`lastName`,`contactNo`,`email`,`roleId`,`password`","'$firstname','$lastname',$cnumber,'$email',$roleid,'$password'");
                    //header('Location: /admin/staffmanage',true,302);

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
                    $this->StaffManageModel->updateData('staff','staffId',$staffid, array('firstName' =>$firstname, 'lastName' =>$lastname, 'contactNo' =>$cnumber, 'email' =>$email,'roleId' =>$roleid,'password' =>$password));
                    //header('Location: /admin/staffmanage',true,302);

            }
            else
            {
                // echo "invalid data";
            }
            

        }
    }
?>