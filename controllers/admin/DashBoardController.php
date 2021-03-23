<?php
    require_once './core/Controller.php';
    
    class DashBoardController extends Controller
    {
        public function __construct()
        {
            require './models/admin/DashBoardModel.php';
            $this->DashBoarModel =new DashBoardModel();
        }
    }
?>