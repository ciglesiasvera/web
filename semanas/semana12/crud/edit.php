<?php
include 'auth.php';
include 'db.php';

$id = $_GET['id'];
$proyecto = $conn->query("SELECT * FROM proyectos WHERE id=$id")->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $titulo = $_POST['titulo'];
  $descripcion = $_POST['descripcion'];
  $url_github = $_POST['url_github'];
  $url_produccion = $_POST['url_produccion'];

  if ($_FILES['imagen']['name']) {
    $imagen = $_FILES['imagen']['name'];
    move_uploaded_file($_FILES['imagen']['tmp_name'], "uploads/$imagen");
    $img_sql = ", imagen='$imagen'";
  } else {
    $img_sql = "";
  }

  $sql = "UPDATE proyectos SET titulo='$titulo', descripcion='$descripcion', url_github='$url_github', url_produccion='$url_produccion' $img_sql WHERE id=$id";
  $conn->query($sql);
  header("Location: index.php");
}
?>

<form method="post" enctype="multipart/form-data">
  <input type="text" name="titulo" value="<?= $proyecto['titulo'] ?>" required><br>
  <textarea name="descripcion"><?= $proyecto['descripcion'] ?></textarea><br>
  <input type="url" name="url_github" value="<?= $proyecto['url_github'] ?>"><br>
  <input type="url" name="url_produccion" value="<?= $proyecto['url_produccion'] ?>"><br>
  <input type="file" name="imagen"><br>
  <button type="submit">Actualizar</button>
</form>