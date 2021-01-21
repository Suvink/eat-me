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
        public function addStaff($firstname,$lastname,$cnumber,$email,$roleid,$password,$re_password){
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
                                echo" password are not match ";
                            }
                        } 
                        else 
                        {
                            echo "role-id need to be less than current role id number";
                        }
                    } 
                    else 
                    {
                        echo "contact number must have 10 numbers";
                    }
                } else {
                    echo " contact-number need to be a number";
                }
                }
                else
                {
                    echo" last names need to be a letters and not contains spaces";
                }
            }
            else
            {
                echo" first names need to be a letters and not contains spaces";
            }
           if($val==1)
           {
                $this->StaffManageModel->writeData("`staff`","`firstName`,`lastName`,`contactNo`,`email`,`roleId`,`password`","'$firstname','$lastname',$cnumber,'$email',$roleid,'$password'");
                header('Loction: /admin/staffmanage,',true,302);
           }
            

        }
    }
?>