<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['username'];
  $password = md5($_POST['password']);

  $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
  $result = $conn->query($sql);

  if ($result->num_rows === 1) {
    $_SESSION['user'] = $username;
    header("Location: index.php");
  } else {
    echo "Credenciales incorrectas.";
  }
}
?>

<form method="post">
  <input type="text" name="username" placeholder="Usuario" required><br>
  <input type="password" name="password" placeholder="Contraseña" required><br>
  <button type="submit">Iniciar Sesión</button>
</form>