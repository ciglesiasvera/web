<?php
// Incluir archivo de configuración de la base de datos
require_once '../config/db_config.php';

// Verificar si se ha proporcionado un ID
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    
    // Consultar el post específico
    $sql = "SELECT * FROM posts WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $post = $result->fetch_assoc();
        
        // Ajustar la ruta de la imagen para que sea accesible desde el frontend
        if (!empty($post['image'])) {
            $post['image'] = '/web/' . $post['image'];
        }
        
        // Devolver como JSON
        header('Content-Type: application/json');
        echo json_encode($post);
    } else {
        // No se encontró el post
        header('HTTP/1.1 404 Not Found');
        echo json_encode(array("error" => "Post no encontrado"));
    }
    
    $stmt->close();
} else {
    // No se proporcionó ID
    header('HTTP/1.1 400 Bad Request');
    echo json_encode(array("error" => "ID no proporcionado"));
}

$conn->close();
?>

