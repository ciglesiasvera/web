<?php
include 'auth.php';
include 'db.php';
$id = $_GET['id'];

$conn->query("DELETE FROM proyectos WHERE id=$id");
header("Location: index.php");
?>