<?php
$servername = "127.0.0.1:3306";
$username = "u104036906_admin";
$password = "Helader@1";
$dbname = "u104036906_nombres";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
