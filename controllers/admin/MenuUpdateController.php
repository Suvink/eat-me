<?php
    require_once './core/Controller.php';

    class MenuUpdateController extends Controller
    {
        public function __construct()
        {
            require './models/admin/MenuUpdateModel.php';
            $this->MenuUpdateModel =new MenuUpdateModel();
        }
        public function renderMainMenu(){
            $result = $this->MenuUpdateModel->getAllDataWhereAnd('menu', 'type', 'mains', 'availability', 'TRUE');
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                if($row['tag'] !="DELETED")
                {
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
                            </form>
                        </div>
                    ';
                }
              }
            }
          }
        public function renderMainMenuHide(){
            $result = $this->MenuUpdateModel->getAllDataWhereAnd('menu', 'type', 'mains', 'availability', 'FALSE');
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                if($row['tag'] !="DELETED")
                {
                    echo '
                        <div class="tray">
                            <form action="" method="POST">
                                <div class="overlayHide ml-0 " id="'.$row['itemNo'].'">
                                    <button class="is-primary btn-edit zoom" name="updateToShow"  id="'.$row['itemNo'].'" value="'.$row['itemNo'].'" >show</button>
                                    <button class="is-primary btn-edit-update zoom" name="updateToUpdate" value="'.$row['itemNo'].'"  id="btnUpdate-'.$row['itemNo'].'">Update</button>
                                </div>
                                <div class="tray-card zoom ml-1 mt-1" onclick="hideOpen('.$row['itemNo'].')">
                                    <div class="column is-2">
                                        <span  class="mt-1 mb-0">'.$row['itemNo'].'</span>
                                    </div>
                                    <div class="column is-10">
                                        <span  class="mt-1 mb-0">'.$row['itemName'].'</span>
                                    </div>
                                </div>
                            </form>
                        </div>
                    ';
                }
              }
            }
          }
        public function renderMainMenuUpdate(){
            $result = $this->MenuUpdateModel->getAllDataWhereAnd('menu', 'type', 'mains', 'availability', 'update');
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                if($row['tag'] !="DELETED")
                {
                    echo '
                        <div class="popup-update" id="popup-1">
                            <div class="popup-overlay-update" id="editOverlay"></div>
                            <form action="" method="POST">
                            <div class="pop-content-update">
                                <div class="close-btn-update zoom" onclick="closepopup01()">&times;</div> 
                                    <div class="columns group">
                                        <div class="column is-12">
                                            <h2>Item <span  class="mt-1 mb-0 font-color">'.$row['itemNo'].'</span></h2>
                                        </div>
                                    </div>
                                    <div class="columns group font">
                                        <div class="column is-4 arrange-position font-color">
                                        Item Name:
                                        </div>
                                        <div  class="column is-8 field artemis-input-field arrange-position">
                                                <input class="artemis-input zoom" type="text" placeholder="Item Name" name="itemName"  value="'.$row['itemName'].'" required>
                                                <span class="label-wrap">
                                                    <span class="label-text">Item Name</span>
                                                </span>
                                        </div>
                                    </div>
                                    <div class="columns group font">
                                        <div class="column is-4 arrange-position font-color">
                                            Price (q1)Rs :
                                        </div>
                                        <div  class="column is-8 field artemis-input-field arrange-position">
                                            <input class="artemis-input zoom" type="text" placeholder="Item Price" name="itemPrice" value="'.$row['price'].'" required>
                                            <span class="label-wrap">
                                                <span class="label-text">Item Price</span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="columns group font">
                                        <div class="column is-12 ">
                                            ________________ <span class="font-color">Item Status is Updating</span> ________________
                                        </div>
                                    </div>
                                    <div class="columns group font">
                                        <div class="column is-12 arrange-position ">
                                            <?php
                                                if('.$row['type'].' == "mains")
                                                {
                                                    ?>
                                                        <span> Mains<input type="radio"  name="itemType" value="mains" checked required></span>
                                                        <span> Starters<input type="radio"  name="itemType" value="starters"  required></span>
                                                        <span>Beverages<input type="radio"  name="itemType" value="beverages" required></span>
                                                        <span>Desserts<input type="radio"  name="itemType" value="desserts"  required></span>
                                                    <?php
                                                }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="columns group">
                                            <div class="column is-3">
                                                <button name="showMenu" id="'.$row['itemNo'].'" value="'.$row['itemNo'].'" class="is-primary btn-color-show zoom" > Show</button>
                                            </div>
                                            <div class="column is-3">
                                                <button name="updateMenu" id="'.$row['itemNo'].'" value="'.$row['itemNo'].'" class="is-primary zoom" > Update</button>
                                            </div>
                                            <div class="column is-3">
                                                <button name="hideMenu" id="'.$row['itemNo'].'" value="'.$row['itemNo'].'" class="is-primary btn-color-hide zoom"> Hide</button>
                                            </div>
                                            <div class="column is-3">
                                                <button name="deleteMenu" id="'.$row['itemNo'].'" value="'.$row['itemNo'].'" class="is-primary btn-color-add zoom" onclick="return confirm(Are you sure you want to delete this item?);"> Delete</button>
                                            </div>
                                    </div>
                            </div> 
                            </form>   

                        </div>
                    
                        <div class="tray">
                            <form action="" method="POST">
                                <div class="overlayHide ml-0 " id="'.$row['itemNo'].'">
                                    <button class="is-primary btn-edit zoom" name="updateToShow"  id="'.$row['itemNo'].'" value="'.$row['itemNo'].'" >show</button>
                                    <button class="is-primary btn-edit-update zoom" name="updateToUpdate" value="'.$row['itemNo'].'"  id="btnUpdate-'.$row['itemNo'].'">Update</button>
                                </div>
                                <div class="tray-card zoom ml-1 mt-1" onclick="hideOpen('.$row['itemNo'].')">
                                    <div class="column is-2">
                                        <span  class="mt-1 mb-0">'.$row['itemNo'].'</span>
                                    </div>
                                    <div class="column is-10">
                                        <span  class="mt-1 mb-0">'.$row['itemName'].'</span>
                                    </div>
                                </div>
                            </form>
                        </div>
                    ';
                }
              }
            }
          }
        public function renderStarters(){
            $result = $this->MenuUpdateModel->getAllDataWhereAnd('menu', 'type', 'starters', 'availability', 'TRUE');
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                if($row['tag'] !="DELETED")
                {
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
                            </form>
                        </div>
                    ';
                }
              }
            }
          }
        public function renderStartersHide(){
            $result = $this->MenuUpdateModel->getAllDataWhereAnd('menu', 'type', 'starters', 'availability', 'FALSE');
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                if($row['tag'] !="DELETED")
                {
                    echo '
                        <div class="tray">
                            <form action="" method="POST">
                                <div class="overlayHide ml-0 " id="'.$row['itemNo'].'">
                                    <button class="is-primary btn-edit zoom" name="updateToShow"  id="'.$row['itemNo'].'" value="'.$row['itemNo'].'" >show</button>
                                    <button class="is-primary btn-edit-update zoom" name="updateToUpdate" value="'.$row['itemNo'].'"  id="btnUpdate-'.$row['itemNo'].'">Update</button>
                                </div>
                                <div class="tray-card zoom ml-1 mt-1" onclick="hideOpen('.$row['itemNo'].')">
                                    <div class="column is-2">
                                        <span  class="mt-1 mb-0">'.$row['itemNo'].'</span>
                                    </div>
                                    <div class="column is-10">
                                        <span  class="mt-1 mb-0">'.$row['itemName'].'</span>
                                    </div>
                                </div>
                            </form>
                        </div>
                    ';
                }
              }
            }
          }
        public function renderStartersUpdate(){
            $result = $this->MenuUpdateModel->getAllDataWhereAnd('menu', 'type', 'starters', 'availability', 'update');
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                if($row['tag'] !="DELETED")
                {
                    echo '
                        <div class="popup-update" id="popup-1">
                            <div class="popup-overlay-update" id="editOverlay"></div>
                            <form action="" method="POST">
                            <div class="pop-content-update">
                                <div class="close-btn-update zoom" onclick="closepopup01()">&times;</div> 
                                    <div class="columns group">
                                        <div class="column is-12">
                                            <h2>Item <span  class="mt-1 mb-0 font-color">'.$row['itemNo'].'</span></h2>
                                        </div>
                                    </div>
                                    <div class="columns group font">
                                        <div class="column is-4 arrange-position font-color">
                                        Item Name:
                                        </div>
                                        <div  class="column is-8 field artemis-input-field arrange-position">
                                                <input class="artemis-input zoom" type="text" placeholder="Item Name" name="itemName"  value="'.$row['itemName'].'" required>
                                                <span class="label-wrap">
                                                    <span class="label-text">Item Name</span>
                                                </span>
                                        </div>
                                    </div>
                                    <div class="columns group font">
                                        <div class="column is-4 arrange-position font-color">
                                            Price (q1)Rs :
                                        </div>
                                        <div  class="column is-8 field artemis-input-field arrange-position">
                                            <input class="artemis-input zoom" type="text" placeholder="Item Price" name="itemPrice" value="'.$row['price'].'" required>
                                            <span class="label-wrap">
                                                <span class="label-text">Item Price</span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="columns group font">
                                        <div class="column is-12 ">
                                            ________________ <span class="font-color">Item Status is Updating</span> ________________
                                        </div>
                                    </div>
                                    <div class="columns group font">
                                        <div class="column is-12 arrange-position ">
                                            <?php
                                                if('.$row['type'].' == "starters")
                                                {
                                                    ?>
                                                        <span> Mains<input type="radio"  name="itemType" value="mains"  required></span>
                                                        <span> Starters<input type="radio"  name="itemType" value="starters" checked required></span>
                                                        <span>Beverages<input type="radio"  name="itemType" value="beverages" required></span>
                                                        <span>Desserts<input type="radio"  name="itemType" value="desserts"  required></span>
                                                    <?php
                                                }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="columns group">
                                            <div class="column is-3">
                                                <button name="showMenu" id="'.$row['itemNo'].'" value="'.$row['itemNo'].'" class="is-primary btn-color-show zoom" > Show</button>
                                            </div>
                                            <div class="column is-3">
                                                <button name="updateMenu" id="'.$row['itemNo'].'" value="'.$row['itemNo'].'" class="is-primary zoom" > Update</button>
                                            </div>
                                            <div class="column is-3">
                                                <button name="hideMenu" id="'.$row['itemNo'].'" value="'.$row['itemNo'].'" class="is-primary btn-color-hide zoom"> Hide</button>
                                            </div>
                                            <div class="column is-3">
                                                <button name="deleteMenu" id="'.$row['itemNo'].'" value="'.$row['itemNo'].'" class="is-primary btn-color-add zoom"> Delete</button>
                                            </div>
                                    </div>
                            </div> 
                            </form>   

                        </div>
                    
                        <div class="tray">
                            <form action="" method="POST">
                                <div class="overlayHide ml-0 " id="'.$row['itemNo'].'">
                                    <button class="is-primary btn-edit zoom" name="updateToShow"  id="'.$row['itemNo'].'" value="'.$row['itemNo'].'" >show</button>
                                    <button class="is-primary btn-edit-update zoom" name="updateToUpdate" value="'.$row['itemNo'].'"  id="btnUpdate-'.$row['itemNo'].'">Update</button>
                                </div>
                                <div class="tray-card zoom ml-1 mt-1" onclick="hideOpen('.$row['itemNo'].')">
                                    <div class="column is-2">
                                        <span  class="mt-1 mb-0">'.$row['itemNo'].'</span>
                                    </div>
                                    <div class="column is-10">
                                        <span  class="mt-1 mb-0">'.$row['itemName'].'</span>
                                    </div>
                                </div>
                            </form>
                        </div>
                    ';
                }
              }
            }
          }
        public function renderBeverages(){
            $result = $this->MenuUpdateModel->getAllDataWhereAnd('menu', 'type', 'beverages', 'availability', 'TRUE');
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                if($row['tag'] !="DELETED")
                {
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
                            </form>
                        </div>
                    ';
                }
              }
            }
          }
        public function renderBeveragesHide(){
            $result = $this->MenuUpdateModel->getAllDataWhereAnd('menu', 'type', 'beverages', 'availability', 'FALSE');
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                if($row['tag'] !="DELETED")
                {
                    echo '
                        <div class="tray">
                            <form action="" method="POST">
                                <div class="overlayHide ml-0 " id="'.$row['itemNo'].'">
                                    <button class="is-primary btn-edit zoom" name="updateToShow"  id="'.$row['itemNo'].'" value="'.$row['itemNo'].'" >show</button>
                                    <button class="is-primary btn-edit-update zoom" name="updateToUpdate" value="'.$row['itemNo'].'"  id="btnUpdate-'.$row['itemNo'].'">Update</button>
                                </div>
                                <div class="tray-card zoom ml-1 mt-1" onclick="hideOpen('.$row['itemNo'].')">
                                    <div class="column is-2">
                                        <span  class="mt-1 mb-0">'.$row['itemNo'].'</span>
                                    </div>
                                    <div class="column is-10">
                                        <span  class="mt-1 mb-0">'.$row['itemName'].'</span>
                                    </div>
                                </div>
                            </form>
                        </div>
                    ';
                }
              }
            }
          }
        public function renderBeveragesUpdate(){
            $result = $this->MenuUpdateModel->getAllDataWhereAnd('menu', 'type', 'beverages', 'availability', 'update');
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                if($row['tag'] !="DELETED")
                {
                    echo '
                        <div class="popup-update" id="popup-1">
                            <div class="popup-overlay-update" id="editOverlay"></div>
                            <form action="" method="POST">
                            <div class="pop-content-update">
                                <div class="close-btn-update zoom" onclick="closepopup01()">&times;</div> 
                                    <div class="columns group">
                                        <div class="column is-12">
                                            <h2>Item <span  class="mt-1 mb-0 font-color">'.$row['itemNo'].'</span></h2>
                                        </div>
                                    </div>
                                    <div class="columns group font">
                                        <div class="column is-4 arrange-position font-color">
                                        Item Name:
                                        </div>
                                        <div  class="column is-8 field artemis-input-field arrange-position">
                                                <input class="artemis-input zoom" type="text" placeholder="Item Name" name="itemName"  value="'.$row['itemName'].'" required>
                                                <span class="label-wrap">
                                                    <span class="label-text">Item Name</span>
                                                </span>
                                        </div>
                                    </div>
                                    <div class="columns group font">
                                        <div class="column is-4 arrange-position font-color">
                                            Price (q1)Rs :
                                        </div>
                                        <div  class="column is-8 field artemis-input-field arrange-position">
                                            <input class="artemis-input zoom" type="text" placeholder="Item Price" name="itemPrice" value="'.$row['price'].'" required>
                                            <span class="label-wrap">
                                                <span class="label-text">Item Price</span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="columns group font">
                                        <div class="column is-12 ">
                                            ________________ <span class="font-color">Item Status is Updating</span> ________________
                                        </div>
                                    </div>
                                    <div class="columns group font">
                                        <div class="column is-12 arrange-position ">
                                            <?php
                                                if('.$row['type'].' == "beverages")
                                                {
                                                    ?>
                                                        <span> Mains<input type="radio"  name="itemType" value="mains"  required></span>
                                                        <span> Starters<input type="radio"  name="itemType" value="starters"  required></span>
                                                        <span>Beverages<input type="radio"  name="itemType" value="beverages" checked required></span>
                                                        <span>Desserts<input type="radio"  name="itemType" value="desserts"  required></span>
                                                    <?php
                                                }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="columns group">
                                            <div class="column is-3">
                                                <button name="showMenu" id="'.$row['itemNo'].'" value="'.$row['itemNo'].'" class="is-primary btn-color-show zoom" > Show</button>
                                            </div>
                                            <div class="column is-3">
                                                <button name="updateMenu" id="'.$row['itemNo'].'" value="'.$row['itemNo'].'" class="is-primary zoom" > Update</button>
                                            </div>
                                            <div class="column is-3">
                                                <button name="hideMenu" id="'.$row['itemNo'].'" value="'.$row['itemNo'].'" class="is-primary btn-color-hide zoom"> Hide</button>
                                            </div>
                                            <div class="column is-3">
                                                <button name="deleteMenu" id="'.$row['itemNo'].'" value="'.$row['itemNo'].'" class="is-primary btn-color-add zoom"  onclick="delete()"> Delete</button>
                                            <script>
                                                function delete() {
                                                    return confirm("Are you sure you want to delete the staff Member?");
                                                }
                                            <script>
                                            </div>
                                    </div>
                            </div> 
                            </form>   

                        </div>
                    
                        <div class="tray">
                            <form action="" method="POST">
                                <div class="overlayHide ml-0 " id="'.$row['itemNo'].'">
                                    <button class="is-primary btn-edit zoom" name="updateToShow"  id="'.$row['itemNo'].'" value="'.$row['itemNo'].'" >show</button>
                                    <button class="is-primary btn-edit-update zoom" name="updateToUpdate" value="'.$row['itemNo'].'"  id="btnUpdate-'.$row['itemNo'].'">Update</button>
                                </div>
                                <div class="tray-card zoom ml-1 mt-1" onclick="hideOpen('.$row['itemNo'].')">
                                    <div class="column is-2">
                                        <span  class="mt-1 mb-0">'.$row['itemNo'].'</span>
                                    </div>
                                    <div class="column is-10">
                                        <span  class="mt-1 mb-0">'.$row['itemName'].'</span>
                                    </div>
                                </div>
                            </form>
                        </div>
                    ';
                }
              }
            }
          }
        public function renderDesserts(){
            $result = $this->MenuUpdateModel->getAllDataWhereAnd('menu', 'type', 'desserts', 'availability', 'TRUE');
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                if($row['tag'] !="DELETED")
                {
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
                            </form>
                        </div>
                    ';
                }
              }
            }
          }
        public function renderDessertsHide(){
            $result = $this->MenuUpdateModel->getAllDataWhereAnd('menu', 'type', 'desserts', 'availability', 'FALSE');
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                if($row['tag'] !="DELETED")
                {
                    echo '
                        <div class="tray">
                            <form action="" method="POST">
                                <div class="overlayHide ml-0 " id="'.$row['itemNo'].'">
                                    <button class="is-primary btn-edit zoom" name="updateToShow"  id="'.$row['itemNo'].'" value="'.$row['itemNo'].'" >show</button>
                                    <button class="is-primary btn-edit-update zoom" name="updateToUpdate" value="'.$row['itemNo'].'"  id="btnUpdate-'.$row['itemNo'].'">Update</button>
                                </div>
                                <div class="tray-card zoom ml-1 mt-1" onclick="hideOpen('.$row['itemNo'].')">
                                    <div class="column is-2">
                                        <span  class="mt-1 mb-0">'.$row['itemNo'].'</span>
                                    </div>
                                    <div class="column is-10">
                                        <span  class="mt-1 mb-0">'.$row['itemName'].'</span>
                                    </div>
                                </div>
                            </form>
                        </div>
                    ';
                }
              }
            }
          }
        public function renderDessertsUpdate(){
            $result = $this->MenuUpdateModel->getAllDataWhereAnd('menu', 'type', 'desserts', 'availability', 'update');
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                  if($row['tag'] !="DELETED")
                  {
                        echo '
                        <div class="popup-update" id="popup-1">
                            <div class="popup-overlay-update" id="editOverlay"></div>
                            <form action="" method="POST">
                            <div class="pop-content-update">
                                <div class="close-btn-update zoom" onclick="closepopup01()">&times;</div> 
                                    <div class="columns group">
                                        <div class="column is-12">
                                            <h2>Item <span  class="mt-1 mb-0 font-color">'.$row['itemNo'].'</span></h2>
                                        </div>
                                    </div>
                                    <div class="columns group font">
                                        <div class="column is-4 arrange-position font-color">
                                        Item Name:
                                        </div>
                                        <div  class="column is-8 field artemis-input-field arrange-position">
                                                <input class="artemis-input zoom" type="text" placeholder="Item Name" name="itemName"  value="'.$row['itemName'].'" required>
                                                <span class="label-wrap">
                                                    <span class="label-text">Item Name</span>
                                                </span>
                                        </div>
                                    </div>
                                    <div class="columns group font">
                                        <div class="column is-4 arrange-position font-color">
                                            Price (q1)Rs :
                                        </div>
                                        <div  class="column is-8 field artemis-input-field arrange-position">
                                            <input class="artemis-input zoom" type="text" placeholder="Item Price" name="itemPrice" value="'.$row['price'].'" required>
                                            <span class="label-wrap">
                                                <span class="label-text">Item Price</span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="columns group font">
                                        <div class="column is-12 ">
                                            ________________ <span class="font-color">Item Status is Updating</span> ________________
                                        </div>
                                    </div>
                                    <div class="columns group font">
                                        <div class="column is-12 arrange-position ">
                                            <?php
                                                if('.$row['type'].' == "desserts")
                                                {
                                                    ?>
                                                        <span> Mains<input type="radio"  name="itemType" value="mains"  required></span>
                                                        <span> Starters<input type="radio"  name="itemType" value="starters"  required></span>
                                                        <span>Beverages<input type="radio"  name="itemType" value="beverages" required></span>
                                                        <span>Desserts<input type="radio"  name="itemType" value="desserts"  checked required></span>
                                                    <?php
                                                }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="columns group">
                                            <div class="column is-3">
                                                <button name="showMenu" id="'.$row['itemNo'].'" value="'.$row['itemNo'].'" class="is-primary btn-color-show zoom" > Show</button>
                                            </div>
                                            <div class="column is-3">
                                                <button name="updateMenu" id="'.$row['itemNo'].'" value="'.$row['itemNo'].'" class="is-primary zoom" > Update</button>
                                            </div>
                                            <div class="column is-3">
                                                <button name="hideMenu" id="'.$row['itemNo'].'" value="'.$row['itemNo'].'" class="is-primary btn-color-hide zoom"> Hide</button>
                                            </div>
                                            <div class="column is-3">
                                                <button name="deleteMenu" id="'.$row['itemNo'].'" value="'.$row['itemNo'].'" class="is-primary btn-color-add zoom"> Delete</button>
                                            </div>
                                    </div>
                            </div> 
                            </form>   

                        </div>
                    
                        <div class="tray">
                            <form action="" method="POST">
                                <div class="overlayHide ml-0 " id="'.$row['itemNo'].'">
                                    <button class="is-primary btn-edit zoom" name="updateToShow"  id="'.$row['itemNo'].'" value="'.$row['itemNo'].'" >show</button>
                                    <button class="is-primary btn-edit-update zoom" name="updateToUpdate" value="'.$row['itemNo'].'"  id="btnUpdate-'.$row['itemNo'].'">Update</button>
                                </div>
                                <div class="tray-card zoom ml-1 mt-1" onclick="hideOpen('.$row['itemNo'].')">
                                    <div class="column is-2">
                                        <span  class="mt-1 mb-0">'.$row['itemNo'].'</span>
                                    </div>
                                    <div class="column is-10">
                                        <span  class="mt-1 mb-0">'.$row['itemName'].'</span>
                                    </div>
                                </div>
                            </form>
                        </div>
                        ';
                    }
               }
            }
          }

          public function updateAvailabilityHide($ans)
          {
              $result = $this->MenuUpdateModel->updateData('menu','itemNo',$ans, array('availability' => 'FALSE'));
          }
          public function deleteMenu($ans)
          {
            $this->MenuUpdateModel->updateData('menu','itemNo',$ans, array('availability' => "FALSE",'tag' =>"DELETED"));
                   
          }
          public function updateAvailabilityShow($ans)
          {
              $result = $this->MenuUpdateModel->updateData('menu','itemNo',$ans, array('availability' => 'TRUE'));
          }
          public function updateAvailabilityUpdate($ans)
          {
              $result = $this->MenuUpdateModel->updateData('menu','itemNo',$ans, array('availability' => 'update'));
          }
          public function hideAllItems()
          {
              $result = $this->MenuUpdateModel->executeSql('UPDATE `menu` SET `availability`="FALSE" WHERE `tag` !="DELETED"');
          }
          public function showAllItems()
          {
              $result = $this->MenuUpdateModel->executeSql('UPDATE `menu` SET `availability`="TRUE" WHERE `tag` !="DELETED" ');
          }
          public function takeNewID()
          {
                $result=$this->MenuUpdateModel->executeSql('SELECT MAX(itemNo) FROM menu');
                $row= mysqli_fetch_assoc($result);
                $val=$row['MAX(itemNo)'];
                return ($val+1);
          }
          public function validation($itemNumber,$itemName,$itemPrice,$itemType)
          {
            $send=0;
            if(is_numeric($itemNumber))
            {
                if(ctype_alpha(str_replace(' ', '', $itemName)) === true)
                {
                  if(preg_match("/^[0-9]+(\.[0-9]{2})?$/", $itemPrice))
                  {
                      if($itemType=="mains")
                      {
                          $send=1;
                      }
                      else if($itemType=="desserts")
                      {
                          $send=1;
                      }
                      else if($itemType=="starters")
                      {
                          $send=1;
                      }
                      else if($itemType=="beverages")
                      {
                          $send=1;
                      }
                      else
                      {
                          echo "Item Type is invalid";
                          $send=0;
                      }
                  }
                  else
                  {
                     // echo "Item Price must contains only numbers";
                      echo '<script language="javascript">';
                      echo 'alert("'.$itemName.'"+" "+"'.$itemPrice.'"+" "+"Price must be a whole number"+"\n"+"=> Invalid data")';
                      echo '</script>';
                      $send=0;
                  }
                }
                else
                {
                    // echo "Item name must contains only latters & spaces";
                    echo '<script language="javascript">';
                    echo 'alert("'.$itemName.'"+" " +"Item name must contains only latters & spaces"+"\n"+"=> Invalid Data")';
                    echo '</script>';
                    $send=0;
                }
            }
            else
            {
                echo '<script language="javascript">';
                echo 'alert("'.$itemName.'"+" "+"'.$itemNumber.'"+" "+"Item number must be a integer"+"\n"+"=> Invalid data")';
                echo '</script>';
                $send=0;
            }
            return $send;
          }
          public function AddMenuItem($itemNumber, $itemName, $itemPrice, $itemType)
          {
            $check2=$this->validation($itemNumber,$itemName,$itemPrice,$itemType);
             
            if($check2==1)
            {
              $result = $this->MenuUpdateModel->writeData("menu","itemNo,itemName,price,type,availability","$itemNumber, '$itemName', $itemPrice, '$itemType','FALSE'");
                $_SESSION['imgeUploadTo']="menu";
                $_SESSION['idUpload']=$itemNumber;
                $_SESSION['itemNameUpload']=$itemName;

            // echo '<script language="javascript">';
            // echo 'alert("'.$id3.'"+" "+"'.$itemName3.'"+" " +"Added to the Inventory")';
            // echo '</script>';
                header('Location: ../../imageuploader');
            }
            else
            {
            
                //   echo" ";
                //   echo "=> Invalid Data";
            }
          }
          public function updateMenu($ans,$itemName,$itemPrice,$itemType)
          {
              $check=$this->validation($ans,$itemName,$itemPrice,$itemType);
             
              if($check==1)
              {
                $result = $this->MenuUpdateModel->updateData('menu','itemNo',$ans, array('itemName' => $itemName, 'price' => $itemPrice,'availability' => 'TRUE', 'type' => $itemType));
                // echo "done";
              }
              else
              {
                $result = $this->MenuUpdateModel->updateData('menu','itemNo',$ans, array('availability' => 'TRUE'));
                    // echo" ";
                    // echo "=> updated to old status";
              }
           
          }
    }
?>