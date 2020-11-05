
<?php

class DBConnection {
    function __construct(){
        require './config/dbcredentials.php';
        $this->db_config = $db_config;
    }

    public function getConnection(){

        // Create connection
        $con = new mysqli($this->db_config['servername'],$this->db_config['username'],$this->db_config['password'],$this->db_config['dbname']);
        
        // Check connection
        if ($con->connect_error) {
            die("Connection failed: " . $con->connect_error);
        } 
        return $con;
    }
}

?>