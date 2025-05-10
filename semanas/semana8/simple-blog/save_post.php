<?php
require 'db.php';

$title = $_POST['title'];
$content = $_POST['content'];

$stmt = $conn->prepare("INSERT INTO posts (title, content) VALUES (?, ?)");
$stmt->bind_param("ss", $title, $content);
$stmt->execute();

$stmt->close();
$conn->close();

header("Location: posts.php");
exit();
?>
