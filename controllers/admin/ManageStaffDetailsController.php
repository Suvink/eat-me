<?php
require_once './core/Controller.php';
session_start();
ob_start();


class ManageStaffDetailsController extends Controller
{
   
  function __construct()
  {
    require './models/admin/ManageStaffDetailsModel.php';
    $this->ManagaeStaffDetailsModel = new ManageStaffDetailsModel();
  }

  public function saveData($staffid, $firstname, $lastname, $contactno, $email, $roleid, $password)
  {
    $result = $this->ManagaeStaffDetailsModell->writeData('staff', "staffId", $staffid);
    
  }
}