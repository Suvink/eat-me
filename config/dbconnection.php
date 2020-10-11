<?php
//Database Connection details  
$servername = "localhost";
$username = "eatme";
$password = "weM2KxUZriR9";
$dbname = "eatme-dev";
// Create connection
$con = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
} 
?> 