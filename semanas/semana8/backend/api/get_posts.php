<?php
// Habilitar reporte de errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Incluir archivo de configuración de la base de datos
require_once '../config/db_config.php';

// Consultar todos los posts ordenados por fecha de creación (más recientes primero)
$sql = "SELECT * FROM posts ORDER BY created_at DESC";
$result = $conn->query($sql);

if (!$result) {
    // Si hay un error en la consulta
    header('HTTP/1.1 500 Internal Server Error');
    echo "Error en la consulta: " . $conn->error;
    exit;
}

$posts = array();

if ($result->num_rows > 0) {
    // Convertir resultados a array
    while($row = $result->fetch_assoc()) {
        // Ajustar la ruta de la imagen para que sea accesible desde el frontend
        if (!empty($row['image'])) {
            // Asegurarse de que la ruta sea absoluta desde la raíz del servidor web
            $row['image'] = '/web/' . $row['image'];
        }
        $posts[] = $row;
    }
}

// Devolver como JSON
header('Content-Type: application/json');
echo json_encode($posts);

$conn->close();
?>



