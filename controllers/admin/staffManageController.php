<?php
    require_once './core/Controller.php';
    session_start();
    ob_start(); 
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
        public function addStaff($staffid,$firstname,$lastname,$cnumber,$email,$roleid,$password){
            
            $this->StaffManageModel->writeData("`staff`","`staffId`,`firstName`,`lastName`,`contactNo`,`email`,`roleId`,`password`","$staffid,'$firstname','$lastname',$cnumber,'$email',$roleid,'$password'");
            header('Location: /admin/staffmanage');
        }
    }
?>