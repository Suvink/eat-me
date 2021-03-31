<?php
    require_once './core/Controller.php';
    class ImageUploaderController extends Controller
    {
        function __construct()
        {
            require './models/store/ImageUploaderModel.php';
            $this->ImageUploaderModel=new ImageUploaderModel();
        }
        public function setUrlInven($path_filename_ext,$id,$name)
        {
            $result=$this->ImageUploaderModel-> updateData('inventory','inventoryId',$id,array('url' =>$path_filename_ext));
            echo '<p class="mt-2 ml-0 mr-5" align=center>Item ID: "'.$_SESSION["idUpload"].'" "'.$_SESSION["itemNameUpload"].'"Added to the inventroy with the IMAGE <span style="color:white">______</span></p>';
            return $result;
        }
        public function setUrlMenu($path_filename_ext,$id,$name)
        {
            $result=$this->ImageUploaderModel-> updateData('menu','itemNo',$id,array('url' =>$path_filename_ext));
            echo '<p class="mt-2 ml-1 mr-5" align=center>Item ID: "'.$_SESSION["idUpload"].'" "'.$_SESSION["itemNameUpload"].'" Added to the menu with the IMAGE <span style="color:white">______</span></p>';
            return $result;
        }

    }