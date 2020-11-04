<?php

class Controller {

    function __construct(){
        
    }

    public function triggerError($message){
        echo '<script src="../../plugins/ArtemisAlert/ArtemisAlert.js"></script>';
        echo "artemisAlert.alert('error', '{$message}')";
    }

}




















?>