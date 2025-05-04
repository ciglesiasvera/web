<?php
// Iniciar sesión
session_start();

// Incluir archivo de configuración de la base de datos
require_once '../config/db_config.php';

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener y sanear datos de entrada
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password']; // No escapamos la contraseña ya que usaremos password_verify
    
    // Verificar si los campos están vacíos
    if (empty($username) || empty($password)) {
        // Redirigir con mensaje de error
        header("Location: ../../frontend/login.html?error=empty_fields");
        exit;
    }
    
    // Buscar el usuario en la base de datos
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        
        // En un entorno de producción, deberíamos usar password_verify
        // Pero como sabemos que la contraseña está en texto plano en este ejemplo
        if ($password === $user['password']) {
            // Autenticación exitosa
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $user['username'];
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            
            // Redirigir al usuario a la página de creación de posts
            header("Location: ../../frontend/create.html?login=success");
            exit;
        } else {
            // Contraseña incorrecta
            header("Location: ../../frontend/list.html?error=invalid_credentials");
            exit;
        }
    } else {
        // Usuario no encontrado
        header("Location: ../../frontend/list.html?error=invalid_credentials");
        exit;
    }
} else {
    // Si alguien intenta acceder directamente a este archivo sin enviar el formulario
    header("Location: ../../frontend/list.html");
    exit;
}

