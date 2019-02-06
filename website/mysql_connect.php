<?php

$servername = "svc353_2.encs.concordia.ca";
$username = "svc353_2";
$password = "M9G9A4UW";
$database = "svc353_2";
 
// Create connection
$conn = new mysqli($servername, $username, $password, $database);
 
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
 
?>