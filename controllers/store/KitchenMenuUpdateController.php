<?php 
    require_once './core/Controller.php';

    class KitchenMenuUpdateController extends Controller
    {
        public function __construct()
        {
            require './models/store/KitchenMenuUpdateModel.php';
            $this->KitchenMenuUpdateModel=new KitchenMenuUpdateModel();
        }

        public function renderMainMenu(){
            $result = $this->KitchenMenuUpdateModel->getAllDataWhereAnd('menu', 'type', 'mains', 'availability', 'true');
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                echo '
                <div class="tray">
                    <form action="" method="POST">
                        <div class="overlay ml-0 " id="'.$row['itemNo'].'">
                            <button class="is-primary btn-edit zoom" onclick="hideClose('.$row['itemNo'].')">show</button>
                        </div>
                        <button class="hide-btn-color" name="updateToHide"  id="'.$row['itemNo'].'" value="'.$row['itemNo'].'">
                        <div class="tray-card zoom ml-1 mt-1" onclick="hideOpen('.$row['itemNo'].')">
                            <div class="column is-2">
                                <span  class="mt-1 mb-0">'.$row['itemNo'].'</span>
                            </div>
                            <div class="column is-10">
                                <span  class="mt-1 mb-0">'.$row['itemName'].'</span>
                            </div>
                        </div>
                        </button>
                    </div>
                    </form>
                ';
              }
            }
          }
        public function renderMainMenuHide(){
            $result = $this->KitchenMenuUpdateModel->getAllDataWhereAnd('menu', 'type', 'mains', 'availability', 'false');
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                echo '
                <div class="tray">
                    <form action="" method="POST">
                        <div class="overlayHide ml-0 " id="'.$row['itemNo'].'">
                            <button class="is-primary btn-edit zoom" name="updateToShow"  id="'.$row['itemNo'].'" value="'.$row['itemNo'].'" >show</button>
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
                    </form>
                ';
              }
            }
          }
        public function renderStarters(){
            $result = $this->KitchenMenuUpdateModel->getAllDataWhereAnd('menu', 'type', 'starters', 'availability', 'true');
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                echo '
                <div class="tray">
                    <form action="" method="POST">
                        <div class="overlay ml-0 " id="'.$row['itemNo'].'">
                            <button class="is-primary btn-edit zoom" onclick="hideClose('.$row['itemNo'].')">show</button>
                        </div>
                        <button class="hide-btn-color" name="updateToHide"  id="'.$row['itemNo'].'" value="'.$row['itemNo'].'">
                        <div class="tray-card zoom ml-1 mt-1" onclick="hideOpen('.$row['itemNo'].')">
                            <div class="column is-2">
                                <span  class="mt-1 mb-0">'.$row['itemNo'].'</span>
                            </div>
                            <div class="column is-10">
                                <span  class="mt-1 mb-0">'.$row['itemName'].'</span>
                            </div>
                        </div>
                        </button>
                    </div>
                    </form>
                ';
              }
            }
          }
        public function renderStartersHide(){
            $result = $this->KitchenMenuUpdateModel->getAllDataWhereAnd('menu', 'type', 'starters', 'availability', 'false');
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                echo '
                <div class="tray">
                <form action="" method="POST">
                    <div class="overlayHide ml-0 " id="'.$row['itemNo'].'">
                        <button class="is-primary btn-edit zoom" name="updateToShow"  id="'.$row['itemNo'].'" value="'.$row['itemNo'].'" >show</button>
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
                </form>
                ';
              }
            }
          }
        public function renderBeverages(){
            $result = $this->KitchenMenuUpdateModel->getAllDataWhereAnd('menu', 'type', 'beverages', 'availability', 'true');
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                echo '
                <div class="tray">
                    <form action="" method="POST">
                        <div class="overlay ml-0 " id="'.$row['itemNo'].'">
                            <button class="is-primary btn-edit zoom" onclick="hideClose('.$row['itemNo'].')">show</button>
                        </div>
                        <button class="hide-btn-color" name="updateToHide"  id="'.$row['itemNo'].'" value="'.$row['itemNo'].'">
                        <div class="tray-card zoom ml-1 mt-1" onclick="hideOpen('.$row['itemNo'].')">
                            <div class="column is-2">
                                <span  class="mt-1 mb-0">'.$row['itemNo'].'</span>
                            </div>
                            <div class="column is-10">
                                <span  class="mt-1 mb-0">'.$row['itemName'].'</span>
                            </div>
                        </div>
                        </button>
                    </div>
                    </form>
                ';
              }
            }
          }
        public function renderBeveragesHide(){
            $result = $this->KitchenMenuUpdateModel->getAllDataWhereAnd('menu', 'type', 'beverages', 'availability', 'false');
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                echo '
                <div class="tray">
                <form action="" method="POST">
                    <div class="overlayHide ml-0 " id="'.$row['itemNo'].'">
                        <button class="is-primary btn-edit zoom" name="updateToShow"  id="'.$row['itemNo'].'" value="'.$row['itemNo'].'" >show</button>
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
                </form>
                ';
              }
            }
          }
        public function renderDesserts(){
            $result = $this->KitchenMenuUpdateModel->getAllDataWhereAnd('menu', 'type', 'desserts', 'availability', 'true');
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                echo '
                <div class="tray">
                    <form action="" method="POST">
                        <div class="overlay ml-0 " id="'.$row['itemNo'].'">
                            <button class="is-primary btn-edit zoom" onclick="hideClose('.$row['itemNo'].')">show</button>
                        </div>
                        <button class="hide-btn-color" name="updateToHide"  id="'.$row['itemNo'].'" value="'.$row['itemNo'].'">
                        <div class="tray-card zoom ml-1 mt-1" onclick="hideOpen('.$row['itemNo'].')">
                            <div class="column is-2">
                                <span  class="mt-1 mb-0">'.$row['itemNo'].'</span>
                            </div>
                            <div class="column is-10">
                                <span  class="mt-1 mb-0">'.$row['itemName'].'</span>
                            </div>
                        </div>
                        </button>
                    </div>
                    </form>
                ';
              }
            }
          }
        public function renderDessertsHide(){
            $result = $this->KitchenMenuUpdateModel->getAllDataWhereAnd('menu', 'type', 'desserts', 'availability', 'false');
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                echo '
                <div class="tray">
                <form action="" method="POST">
                    <div class="overlayHide ml-0 " id="'.$row['itemNo'].'">
                        <button class="is-primary btn-edit zoom" name="updateToShow"  id="'.$row['itemNo'].'" value="'.$row['itemNo'].'" >show</button>
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
                </form>
                ';
              }
            }
          }

        public function updateAvailabilityHide($ans)
        {
            $result = $this->KitchenMenuUpdateModel->updateData('menu','itemNo',$ans, array('availability' => 'false'));
        }
        public function updateAvailabilityShow($ans)
        {
            $result = $this->KitchenMenuUpdateModel->updateData('menu','itemNo',$ans, array('availability' => 'true'));
        }
        public function hideAllItems()
        {
            $result = $this->KitchenMenuUpdateModel->executeSql('UPDATE `menu` SET `availability`="false" WHERE 1');
        }
        public function showAllItems()
        {
            $result = $this->KitchenMenuUpdateModel->executeSql('UPDATE `menu` SET `availability`="true" WHERE 1');
        }
    }
?>
