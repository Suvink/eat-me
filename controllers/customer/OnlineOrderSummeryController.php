<?php

require_once './core/Controller.php';

class OnlineOrderSummeryController extends Controller{

  function __construct()
  {
    require './models/customer/OnlineOrderSummeryModal.php';
    $this->OnlineOrderSummeryModal = new OnlineOrderSummeryModal();
    
  }



  

}

?>