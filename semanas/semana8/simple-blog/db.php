<?php
$conn = new mysqli('localhost', 'root', '', 'simple_blogdb');
if ($conn->connect_error) {
  die("Conexión fallida: " . $conn->connect_error);
}
?>
