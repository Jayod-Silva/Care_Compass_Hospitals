<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "care_compass_hospital"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
?>