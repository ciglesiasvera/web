<?php require 'db.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Lista de Posts</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
  <h2 class="mb-4">Posts del Blog</h2>
  <a href="create.php" class="btn btn-primary mb-3">Crear nuevo post</a>
  <a href="index.html" class="btn btn-secondary mb-3">Inicio</a>

  <?php
  $result = $conn->query("SELECT * FROM posts ORDER BY created_at DESC");
  while($row = $result->fetch_assoc()):
  ?>
    <div class="card mb-3">
      <div class="card-body">
        <h5 class="card-title"><?php echo htmlspecialchars($row['title']); ?></h5>
        <p class="card-text"><?php echo nl2br(htmlspecialchars($row['content'])); ?></p>
        <p class="card-text"><small class="text-muted">Publicado: <?php echo $row['created_at']; ?></small></p>
      </div>
    </div>
  <?php endwhile; ?>
</div>
</body>
</html>
