<?php
$servername = "localhost";
$username = "stella";
$password = "stella";
$dbname = "vital";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
