<?php
require_once './core/Controller.php';

class StewardController extends Controller{
    
    function __construct()
    {
      require './models/store/StewardModel.php';
      $this->StewardModel = new StewardModel();
    }
           
}