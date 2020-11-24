<?php 
    session_start();
    ob_start();
    require_once './core/Controller.php';

    class KitchenMenuUpdateController extends Controller
    {
        public function __construct()
        {
            require './models/store/KitchenMenuUpdateModel.php';
            $this->KitchenMenuUpdateModel=new KitchenMenuUpdateModel();
        }

        public function renderMainMenu(){
            $result = $this->KitchenMenuUpdateModel->getAllDataWhere('menu', 'type', 'mains');
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                echo '
                <div class="tray">
                        <div class="overlay ml-0 " id="'.$row['itemNo'].'">
                            <button class="is-primary btn-edit zoom" onclick="hideClose('.$row['itemNo'].')">show</button>
                        </div>
                        <div class="tray-card zoom ml-1 mt-1" onclick="hideOpen('.$row['itemNo'].')">
                            <div class="column is-2">
                                <span  class="mt-1 mb-0">'.$row['itemNo'].'</span>
                            </div>
                            <div class="column is-10">
                                <span  class="mt-1 mb-0">'.$row['itemName'].'</span>
                            </div>
                        </div>
                    </div>
                ';
              }
            }
          }
        public function renderStarters(){
            $result = $this->KitchenMenuUpdateModel->getAllDataWhere('menu', 'type', 'starters');
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                echo '
                <div class="tray">
                        <div class="overlay ml-0" id="'.$row['itemNo'].'">
                            <button class="is-primary btn-edit zoom" onclick="hideClose('.$row['itemNo'].')">show</button>
                        </div>
                        <div class="tray-card zoom ml-1 mt-1" onclick="hideOpen('.$row['itemNo'].')">
                            <div class="column is-2">
                                <span  class="mt-1 mb-0">'.$row['itemNo'].'</span>
                            </div>
                            <div class="column is-10">
                                <span  class="mt-1 mb-0">'.$row['itemName'].'</span>
                            </div>
                        </div>
                    </div>
                ';
              }
            }
          }
        public function renderBeverages(){
            $result = $this->KitchenMenuUpdateModel->getAllDataWhere('menu', 'type', 'beverages');
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                echo '
                <div class="tray">
                        <div class="overlay ml-0" id="'.$row['itemNo'].'">
                            <button class="is-primary btn-edit zoom" onclick="hideClose('.$row['itemNo'].')">show</button>
                        </div>
                        <div class="tray-card zoom ml-1 mt-1" onclick="hideOpen('.$row['itemNo'].')">
                            <div class="column is-2">
                                <span  class="mt-1 mb-0">'.$row['itemNo'].'</span>
                            </div>
                            <div class="column is-10">
                                <span  class="mt-1 mb-0">'.$row['itemName'].'</span>
                            </div>
                        </div>
                    </div>
                ';
              }
            }
          }
        public function renderDesserts(){
            $result = $this->KitchenMenuUpdateModel->getAllDataWhere('menu', 'type', 'desserts');
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                echo '
                <div class="tray">
                        <div class="overlay ml-0" id="'.$row['itemNo'].'">
                            <button class="is-primary btn-edit zoom" onclick="hideClose('.$row['itemNo'].')">show</button>
                        </div>
                        <div class="tray-card zoom ml-1 mt-1" onclick="hideOpen('.$row['itemNo'].')">
                            <div class="column is-2">
                                <span  class="mt-1 mb-0">'.$row['itemNo'].'</span>
                            </div>
                            <div class="column is-10">
                                <span  class="mt-1 mb-0">'.$row['itemName'].'</span>
                            </div>
                        </div>
                    </div>
                ';
              }
            }
          }
    }
?>
