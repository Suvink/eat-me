<?php
require_once './core/Controller.php';

class DeliveryPersonController extends Controller{
    
    function __construct()
    {
      require './models/store/DeliveryPersonModel.php';
      $this->DeliveryPersonModel = new DeliveryPersonModel();
    }
           
}