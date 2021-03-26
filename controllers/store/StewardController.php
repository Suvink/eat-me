<?php
require_once './core/Controller.php';

class StewardController extends Controller{
    
    function __construct()
    {
      require './models/store/StewardModel.php';
      $this->StewardModel = new StewardModel();
    }
    function renderAssignedOrders(){
      echo
        '<tr>
          <td>1001</td>
          <td>Mr.MR</td>
          <td>Coca Cola</td>
          <td>LKR 230.00</td>
          <td>8</td>
          <td>
            <select name="Status" id="Status" onchange="popupRate()">
              <option value="Preparing">Preparing</option>
              <option value="Prepared">Prepared</option>
              <option value="Served">Served</option>
              <option value="Completed">Completed</option>
            </select>
          </td>
        </tr>';
    }
           
}