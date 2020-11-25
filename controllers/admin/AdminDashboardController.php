<?php
    require_once './core/Controller.php';
   

    class AdminDashboardController extends Controller{

        function __construct()
        {
          require './models/admin/AdminDashboardModel.php';
          $this->AdminDashboardModel = new AdminDashboardModel();
        }
        public function logout(){
            session_destroy();
            unset($_SESSION['staffId']);
            header("Location: /staff/login",TRUE,302);
          }
    }
?>