<?php
$servername = "localhost";
$username = "root"; 
$password = "Karri4629$$";
$database = "eventhub"; 

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
