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
            $result = $this->MenuUpdateModel->getAllDataWhere('menu', 'type', 'mains');
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                echo '
                    <div class="popup" id="popup-1">
                        <div class="popup-overlay" id="editOverlay"></div>
                        <div class="pop-content">
                            <div class="close-btn zoom" onclick="closepopup01()">&times;</div> 
                                <div class="columns group">
                                    <div class="column is-12">
                                        <h2>Item 1155kL</h2>
                                    </div>
                                </div>
                                <div class="columns group font">
                                    <div class="column is-6">
                                        Name :
                                    </div>
                                    <div class="column is-6 font">
                                        Chicken Fried Rice
                                    </div>
                                </div>
                                <div class="columns group font">
                                    <div class="column is-6">
                                        Price (q1):
                                    </div>
                                    <div class="column is-6 font">
                                        Rs 780.00
                                    </div>
                                </div>
                                <div class="columns group">
                                    <div class="column is-12">
                                        <button class="is-primary" > Update</button>
                                    </div>
                                </div>
                        </div>    

                    </div>
                   
                    <div class="tray">
                        <div class="overlay ml-0 " id="'.$row['itemNo'].'">
                            <button class="is-primary btn-edit zoom" onclick="hideClose('.$row['itemNo'].')" id="btnShow">show</button>
                            <button class="is-primary btn-edit-update zoom" onclick="hideUpdatebtn('.$row['itemNo'].');togglePopup1()" id="btnUpdate-'.$row['itemNo'].'">Update</button>
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
            $result = $this->MenuUpdateModel->getAllDataWhere('menu', 'type', 'starters');
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                echo '
                <div class="popup" id="popup-1">
                <div class="popup-overlay" id="editOverlay"></div>
                <div class="pop-content">
                    <div class="close-btn zoom" onclick="closepopup01()">&times;</div> 
                        <div class="columns group">
                            <div class="column is-12">
                                <h2>Item 1155kL</h2>
                            </div>
                        </div>
                        <div class="columns group font">
                            <div class="column is-6">
                                Name :
                            </div>
                            <div class="column is-6 font">
                                Chicken Fried Rice
                            </div>
                        </div>
                        <div class="columns group font">
                            <div class="column is-6">
                                Price (q1):
                            </div>
                            <div class="column is-6 font">
                                Rs 780.00
                            </div>
                        </div>
                        <div class="columns group">
                            <div class="column is-12">
                                <button class="is-primary" > Update</button>
                            </div>
                        </div>
                </div>    

            </div>
           
            <div class="tray">
                <div class="overlay ml-0 " id="'.$row['itemNo'].'">
                    <button class="is-primary btn-edit zoom" onclick="hideClose('.$row['itemNo'].')" id="btnShow">show</button>
                    <button class="is-primary btn-edit-update zoom" onclick="hideUpdatebtn('.$row['itemNo'].');togglePopup1()" id="btnUpdate-'.$row['itemNo'].'">Update</button>
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
            $result = $this->MenuUpdateModel->getAllDataWhere('menu', 'type', 'beverages');
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                echo '
                <div class="popup" id="popup-1">
                        <div class="popup-overlay" id="editOverlay"></div>
                        <div class="pop-content">
                            <div class="close-btn zoom" onclick="closepopup01()">&times;</div> 
                                <div class="columns group">
                                    <div class="column is-12">
                                        <h2>Item 1155kL</h2>
                                    </div>
                                </div>
                                <div class="columns group font">
                                    <div class="column is-6">
                                        Name :
                                    </div>
                                    <div class="column is-6 font">
                                        Chicken Fried Rice
                                    </div>
                                </div>
                                <div class="columns group font">
                                    <div class="column is-6">
                                        Price (q1):
                                    </div>
                                    <div class="column is-6 font">
                                        Rs 780.00
                                    </div>
                                </div>
                                <div class="columns group">
                                    <div class="column is-12">
                                        <button class="is-primary" > Update</button>
                                    </div>
                                </div>
                        </div>    

                    </div>
                   
                    <div class="tray">
                        <div class="overlay ml-0 " id="'.$row['itemNo'].'">
                            <button class="is-primary btn-edit zoom" onclick="hideClose('.$row['itemNo'].')" id="btnShow">show</button>
                            <button class="is-primary btn-edit-update zoom" onclick="hideUpdatebtn('.$row['itemNo'].');togglePopup1()" id="btnUpdate-'.$row['itemNo'].'">Update</button>
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
            $result = $this->MenuUpdateModel->getAllDataWhere('menu', 'type', 'desserts');
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                echo '
                <div class="popup" id="popup-1">
                <div class="popup-overlay" id="editOverlay"></div>
                <div class="pop-content">
                    <div class="close-btn zoom" onclick="closepopup01()">&times;</div> 
                        <div class="columns group">
                            <div class="column is-12">
                                <h2>Item 1155kL</h2>
                            </div>
                        </div>
                        <div class="columns group font">
                            <div class="column is-6">
                                Name :
                            </div>
                            <div class="column is-6 font">
                                Chicken Fried Rice
                            </div>
                        </div>
                        <div class="columns group font">
                            <div class="column is-6">
                                Price (q1):
                            </div>
                            <div class="column is-6 font">
                                Rs 780.00
                            </div>
                        </div>
                        <div class="columns group">
                            <div class="column is-12">
                                <button class="is-primary" > Update</button>
                            </div>
                        </div>
                </div>    

            </div>
           
            <div class="tray">
                <div class="overlay ml-0 " id="'.$row['itemNo'].'">
                    <button class="is-primary btn-edit zoom" onclick="hideClose('.$row['itemNo'].')" id="btnShow">show</button>
                    <button class="is-primary btn-edit-update zoom" onclick="hideUpdatebtn('.$row['itemNo'].');togglePopup1()" id="btnUpdate-'.$row['itemNo'].'">Update</button>
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