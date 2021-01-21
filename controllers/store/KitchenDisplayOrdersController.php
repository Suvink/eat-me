<?php
require_once './core/Controller.php';

class KitchenDisplayOrdersController extends Controller
{
    public function __construct()
    {
        require './models/store/KitchenDisplayOrdersModel.php';
        $this->KitchenDisplayOrdersModel = new KitchenDisplayOrdersModel();
    }

    public function getOrderDetails()
    {
        $result = $this->KitchenDisplayOrdersModel->getAllDataWhere('order_details',' orderType','on');
        return $result;
    }
}

?>