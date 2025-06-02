<?php
$host = "localhost";
$db = "cristian_iglesias_db1";
$user = "cristian_iglesias";
$pass = "cristian_iglesias2025";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
  die("Error de conexión: " . $conn->connect_error);
}
?>