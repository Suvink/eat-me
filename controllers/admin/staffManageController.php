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
    }
?>