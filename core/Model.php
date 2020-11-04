<?php
require_once './core/DBConnection.php';

class Model {
    public $con = null;

    public function __construct(){
        $db = new DBConnection();
        $this->con =  $db->getConnection();
    }

    //writeData("customer", "'id', 'phone', 'nic'", "'1212', 'sumanapala', '1231231'");
    //INSERT INTO customer ('id', 'phone', 'nic') VALUES ('1212', 'sumanapala', '1231231')
    public function writeData($tableName, $columns, $data){
        $sql = 'INSERT INTO '.$tableName.' ('.$columns.' ) VALUES ('.$data.');';
        $result =  $this->con->query($sql);
        
        if ($this->con->query($sql) === FALSE) {
            echo "Database Error";
          } else {
            return $this->$result; 
        }
    }

    //getAllData(customer)
    //SELECT * FROM customer
    public function getAllData($tableName){
        $sql = 'SELECT * FROM '.$tableName;
        $result =  $this->con->query($sql);
        
        if ($this->con->query($sql) === FALSE) {
            echo "No data";
          } else {
            return $this->$result; 
        }
    }

    //getAllDataWhere('customer', 'phone', '0771655198')
    //SELECT * FROM customer WHERE phone=0771655198
    public function getAllDataWhere($tableName, $column, $data){
        $sql = 'SELECT * FROM '.$tableName.' WHERE '.$column.'="'.$data.'"';
        $result =  $this->con->query($sql);
        
        if ($this->con->query($sql) === FALSE) {
            echo "No data";
          } else {
            return $result; 
        }
    }

    //updateData('customer', 'phone', 0771655198', array('fname' => 'Suvin', 'lname' => 'Nimnaka' ))
    // This is equivilent to UPDATE customer SET "fname"="suvin", "lname"="nimnaka" WHERE "phone"="0771655198";
    public function updateData($tableName, $key, $keyvalue, $data) {
        $set = '';
        $x = 1;
    
        foreach($data as $name => $value) {
            $set .= "{$name} = \"{$value}\"";
            if($x < count($data)) {
                $set .= ',';
            }
            $x++;
        }
    
        $sql = "UPDATE {$tableName} SET {$set} WHERE {$key} = {$keyvalue}";
    
        if(!$this->con->query($sql, $data)->error()) {
            return true;
        }
    
        return false;
    }

    //deleteTable('customer', 'phone', '0771655198')
    // Equilent to DELETE FROM customer WHERE 'phone'='0771655198'
    function deleteData($tableName, $key, $keyvalue){
        $sql = "DELETE FROM {$tableName} WHERE {$key}='{$keyvalue}'";
        $result =  $this->con->query($sql);

        if ($this->con->query($sql) === FALSE) {
            echo "Delete Error";
        } else {
            return $result; 
        }
    }



    //ona magulak meken puluwan
    public function executeSql($query){
        $result =  $this->con->query($query);
        
        if ($this->con->query($query) === FALSE) {
            echo "No data";
          } else {
            return $result; 
        }
    }
    

}
