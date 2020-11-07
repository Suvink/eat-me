<?php
    require_once  './core/Controller.php';
    session_start();
    ob_start();

    class KitchenDisplayDineinOrdersController extends Controller
    {
        public function __construct()
        {
            require './models/store/KitchenDisplayDineinOrdersModel.php';
            $this->KitchenDisplayDineinOrdersModel =new KitchenDiplayDineinOrdersModel;
        }
        
        public function getOrderDetails()
        {
            $result = $this->KitchenDisplayDineinOrdersModel->getAllDataWhere('order_details',' orderType','di');
            return $result;
        }
    }
?>