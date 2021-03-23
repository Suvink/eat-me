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
            $result = $this->KitchenMenuUpdateModel->getAllDataWhereAnd('menu', 'type', 'mains', 'availability', 'show');
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
            $result = $this->KitchenMenuUpdateModel->getAllDataWhereAnd('menu', 'type', 'mains', 'availability', 'hide');
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
            $result = $this->KitchenMenuUpdateModel->getAllDataWhereAnd('menu', 'type', 'starters', 'availability', 'show');
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
            $result = $this->KitchenMenuUpdateModel->getAllDataWhereAnd('menu', 'type', 'starters', 'availability', 'hide');
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
            $result = $this->KitchenMenuUpdateModel->getAllDataWhereAnd('menu', 'type', 'beverages', 'availability', 'show');
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
            $result = $this->KitchenMenuUpdateModel->getAllDataWhereAnd('menu', 'type', 'beverages', 'availability', 'hide');
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
            $result = $this->KitchenMenuUpdateModel->getAllDataWhereAnd('menu', 'type', 'desserts', 'availability', 'show');
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
            $result = $this->KitchenMenuUpdateModel->getAllDataWhereAnd('menu', 'type', 'desserts', 'availability', 'hide');
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
            $result = $this->KitchenMenuUpdateModel->updateData('menu','itemNo',$ans, array('availability' => 'hide'));
        }
        public function updateAvailabilityShow($ans)
        {
            $result = $this->KitchenMenuUpdateModel->updateData('menu','itemNo',$ans, array('availability' => 'show'));
        }
        public function hideAllItems()
        {
            $result = $this->KitchenMenuUpdateModel->executeSql('UPDATE `menu` SET `availability`="hide" WHERE 1');
        }
        public function showAllItems()
        {
            $result = $this->KitchenMenuUpdateModel->executeSql('UPDATE `menu` SET `availability`="show" WHERE 1');
        }
    }
?>
