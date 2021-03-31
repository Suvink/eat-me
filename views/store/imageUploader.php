<?php
session_start();
ob_start();
require_once './controllers/store/ImageUploaderController.php';
$ImageUploaderController= new ImageUploaderController();

// echo $_SESSION['imgeUploadTo'];
//   echo          $_SESSION['idInventory'];
//      echo       $_SESSION['itemNameInven'];


$style1= "style=display:none";
$style2= "style=display:none";
$style3= "style=display:none";
$style4= "style=display:none";
if($_SESSION['uploadStatus']=="upload")
{
    if($_SESSION['imgeUploadTo']=="inventory")
    {
        $style1="style=display:block";
        $style2= "style=display:none";
        $style3= "style=display:none";
        $style4= "style=display:none";
        echo '<p class="mt-2 mr-5" align=center>Item ID: "'.$_SESSION["idUpload"].'" "'.$_SESSION["itemNameUpload"].'" Added to the menu</p>';
    }
    else if($_SESSION['imgeUploadTo']=="menu")
    {
        $style1= "style=display:none";
        $style2= "style=display:none";
        $style3= "style=display:block";
        $style4= "style=display:none";
        echo '<p class="mt-2 mr-5" align=center>Item ID: "'.$_SESSION["idUpload"].'" "'.$_SESSION["itemNameUpload"].'" Added to the menu</p>';
        // echo '<script language="javascript">';
        // echo 'alert("Item ID: "+"'.$_SESSION['idUpload'].'"+" "+"'. $_SESSION['itemNameUpload'].'"+" "+" Added to the menu. Now you can upload an image ")';
        // echo '</script>';
    }
}
if($_SESSION['uploadStatus']=="manage")
{
    if($_SESSION['imgeUploadTo']=="inventory")
    {
        $style1="style=display:block";
        $style2= "style=display:none";
        echo '<p class="mt-2 mr-5" align=center>Going to upload new Image for   Item ID: "'.$_SESSION["idUpload"].'" "'.$_SESSION["itemNameUpload"].'"</p>';
    }
    else if($_SESSION['imgeUploadTo']=="menu")
    {
        $style1= "style=display:none";
        $style2= "style=display:block";
        echo '<p class="mt-2 mr-5" align=center>Item ID: "'.$_SESSION["idUpload"].'" "'.$_SESSION["itemNameUpload"].'" Added to the menu</p>';
        // echo '<script language="javascript">';
        // echo 'alert("Item ID: "+"'.$_SESSION['idUpload'].'"+" "+"'. $_SESSION['itemNameUpload'].'"+" "+" Added to the menu. Now you can upload an image ")';
        // echo '</script>';
    }
}



if(isset($_POST['back']))
{
    if($_SESSION['imgeUploadTo']=="inventory")
    {
        header('Location: ../../inventory');
    }
    if($_SESSION['imgeUploadTo']=="menu")
    {
        header('Location: ../../admin/menu/update');
    }
    
}
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- global styles -->
        <link rel="stylesheet" href="../../css/style.css">
        <!-- local styles -->
        <link rel="stylesheet" href="../../css/kitchendisplay.css">
        <link rel="stylesheet" href="../../css/adminMenuUpdate.css">
        <title>Image Uploader</title>
       
    </head>
    <body>
        <section>
            <div class="popup-update" id="popup-3">
                <div class="popup-overlay-update" id="editOverlay"></div>
                    <div class="pop-content-update">
                        <!-- <div class="close-btn-update zoom" onclick="closepopup01()">&times;</div> -->
                        <form name="form" method="post" action="" enctype="multipart/form-data" >
                            <div class="columns group mt-1">
                                <div class="column is-12 mb-0">
                                    <div class="">
                                        <h1 class="title mt-0 ">Image<span class="orange-color">Uploader</span></h1>
                                    </div>
                                </div>
                                <div class="menu-cards  mt-2" >
                                <div class="menu-card mt-1 ml-4" style="width:300px;height:200px">
                                    <div class="columns group">    
                                        <div class="column is-12">
                                            <input type="file" class="button is-primary adj-size change-file" name="my_file" /><br /><br />
                                        </div>
                                    </div>
                                    <!-- <div class="columns group mt-0">
                                        <div class="column is-8 field artemis-input-field arrange-position">
                                            <input class="artemis-input zoom" type="text" placeholder="Id number" name="id"  required>
                                            <span class="label-wrap">
                                                <span class="label-text">Id number here</span>
                                            </span>
                                        </div>
                                    </div>  -->
                                    <div class="columns group mt-1" <?php echo $style1 ?>>    
                                        <div class="column is-12">
                                            <button style="width:300px " type="submit" name="submit" id="auto" value="inventory">Upload Image To Inventory</button>
                                        </div>
                                    </div>
                                    <div class="columns group mt-1 " <?php echo $style2 ?>>    
                                        <div class="column is-12">
                                            <button style="width:300px" type="submit" name="submit" id="auto" value="menu">Uplaod Image To Menu</button>
                                        </div>
                                    </div>
                                    <div class="columns group mt-1" <?php echo $style3 ?>>    
                                        <div class="column is-12">
                                            <button style="width:300px " type="submit" name="submit" id="auto" value="inventory">Upload New Image to Inventroy</button>
                                        </div>
                                    </div>
                                    <div class="columns group mt-1 " <?php echo $style4 ?>>    
                                        <div class="column is-12">
                                            <button style="width:300px" type="submit" name="submit" id="auto" value="menu">Upload New Image to Menu</button>
                                        </div>
                                    </div>
                                    <div class="columns group mt-1 ">    
                                        <div class="column is-12">
                                            <button style="width:300px" type="submit" name="back" id="auto" value="menu" onclick="return confirm('Are you sure that you want to go back?');">Back</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
            </div>  
        </section>

    </body>
</html>
<?php

    $pathImg=null;
    function ext($i_id)
    {
        $itemID = $i_id;
        return $itemID;
    }
    if(isset($_POST['submit']))
    {
        $ans = ext($_REQUEST['submit']);
        if($ans=="inventory")
        {
            $pathImg="img/inventory/";
        }
        else if($ans=="menu")
        {
            $pathImg="img/menu/";
        }
        if( $pathImg!=null)
        {
            if (($_FILES['my_file']['name']!=""))
            {
                // Where the file is going to be stored
                $target_dir = $pathImg;
            
                $file = $_FILES['my_file']['name'];
                $path = pathinfo($file);
                $filename = $path['filename'];
                $ext = $path['extension'];
                $temp_name = $_FILES['my_file']['tmp_name'];
                $path_filename_ext = $target_dir.$filename.".".$ext;
                
                // Check if file already exists
                if (file_exists($path_filename_ext)) 
                {
                    echo'<p class="mt-2 mr-5" align=center>Sorry, Image already exists. </p> <?php';
                }
                else
                {
                    // echo $path_filename_ext;
                    // define ('SITE_ROOT', realpath(dirname(__FILE__)));
                    move_uploaded_file($temp_name,$path_filename_ext);
                    //File Uploaded Successfully.";
                    echo'<p class="mt-2 mr-5" align=center>Image Uploaded Successfully. </p><p align=center> <?php';
                    if($_SESSION['imgeUploadTo']=="inventory")
                    {
                        $ImageUploaderController->setUrlInven($path_filename_ext,$_SESSION['idUpload'],$_SESSION['itemNameUpload']);
                    }
                    if($_SESSION['imgeUploadTo']=="menu")
                    {
                        $ImageUploaderController->setUrlMenu($path_filename_ext,$_SESSION['idUpload'],$_SESSION['itemNameUpload']);
                    }
 
                    
                }
            }
        
        }
    }

    ?>