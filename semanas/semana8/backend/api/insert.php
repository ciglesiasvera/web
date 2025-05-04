<?php
// Incluir archivo de verificación de autenticación
require_once '../auth/check_auth.php';

// Verificar si el usuario está autenticado
requireLogin();

// Incluir archivo de configuración de la base de datos
require_once '../config/db_config.php';

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanear datos
    $title = $conn->real_escape_string($_POST['title']);
    $body = $conn->real_escape_string($_POST['body']);
    $author = $conn->real_escape_string($_POST['author']);
    $category = $conn->real_escape_string($_POST['category']);
    $imagePath = NULL;
    
    // Si el usuario está autenticado, usar su nombre como autor
    if (isLoggedIn()) {
        $author = $_SESSION['username']; // Usar el nombre de usuario de la sesión
    }

    // Proceso de subida de imagen
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        // Definir la ruta de la carpeta de uploads específica para el blog de la semana 8
        $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/web/assets/uploads/semana8/blog/';
        
        // Crear directorio si no existe
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        
        // Generar nombre único
        $fileName = uniqid() . '_' . basename($_FILES['image']['name']);
        $uploadFile = $uploadDir . $fileName;
        
        // Mover archivo
        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
            // Guardar ruta relativa en la base de datos
            $imagePath = 'assets/uploads/semana8/blog/' . $fileName;
        } else {
            // Log error de subida
            error_log("Error al subir imagen: " . $_FILES['image']['error']);
        }
    }

    // Insertar en la base de datos
    $sql = "INSERT INTO posts (title, body, author, category, image) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $title, $body, $author, $category, $imagePath);
    
    if ($stmt->execute()) {
        // Redirigir a la página de listado con mensaje de éxito
        header("Location: ../../frontend/list.html?msg=success");
        exit;
    } else {
        echo "Error al guardar: " . $conn->error;
    }
    
    $stmt->close();
    $conn->close();
}
?>


