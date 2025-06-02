<?php
include 'auth.php';
include 'db.php';
$result = $conn->query("SELECT * FROM proyectos ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="icon" href="../../assets/imgs/icon.png">
  <title>Clase Semana 8 - PHP y MySQL</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="../../assets/css/semanas/semana10/style.css">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.4.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <a href="add.php" class="btn btn-success"><i class="fa fa-plus"></i> Agregar Proyecto</a>
    <a href="logout.php" class="btn btn-outline-danger">Cerrar sesión</a>
  </div>
  <h2 class="mb-4">Proyectos</h2>
  <?php while($row = $result->fetch_assoc()): ?>
    <div class="card mb-3 shadow-sm">
      <div class="row g-0">
        <div class="col-md-3 d-flex align-items-center justify-content-center p-2">
          <img src="uploads/<?= $row['imagen'] ?>" class="img-fluid rounded" style="max-width: 150px;" alt="<?= $row['titulo'] ?>">
        </div>
        <div class="col-md-9">
          <div class="card-body">
            <h3 class="card-title"><?= $row['titulo'] ?></h3>
            <p class="card-text"><?= $row['descripcion'] ?></p>
            <a href="<?= $row['url_github'] ?>" class="btn btn-dark btn-sm me-2" target="_blank"><i class="fab fa-github"></i> GitHub</a>
            <a href="<?= $row['url_produccion'] ?>" class="btn btn-primary btn-sm me-2" target="_blank"><i class="fa fa-link"></i> Enlace</a>
            <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm me-2"><i class="fa fa-edit"></i> Editar</a>
            <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro?')"><i class="fa fa-trash"></i> Eliminar</a>
          </div>
        </div>
      </div>
    </div>
  <?php endwhile; ?>
</div>
</body>
</html>

<a href="add.php">+ Agregar Proyecto</a> | <a href="logout.php">Cerrar sesión</a>
<h2>Proyectos</h2>
<?php while($row = $result->fetch_assoc()): ?>
  <div>
    <h3><?= $row['titulo'] ?></h3>
    <p><?= $row['descripcion'] ?></p>
    <img src="uploads/<?= $row['imagen'] ?>" width="150"><br>
    <a href="<?= $row['url_github'] ?>">GitHub</a> |
    <a href="<?= $row['url_produccion'] ?>">Enlace</a><br>
    <a href="edit.php?id=<?= $row['id'] ?>">Editar</a> |
    <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('¿Seguro?')">Eliminar</a>
  </div>
  <hr>
<?php endwhile; ?>