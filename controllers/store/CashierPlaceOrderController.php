<?php

require_once './core/Controller.php';

class CashierPlaceOrderController extends Controller
{
    function __construct()
  {
    require './models/store/CashierPlaceOrderModel.php';
    $this->CashierPlaceOrderModel = new CashierPlaceOrderModel();
  }
  public function renderItemDisplayTable(){
      
  }
}

?>