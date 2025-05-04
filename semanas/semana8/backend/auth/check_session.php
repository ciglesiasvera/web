<?php
// Iniciar sesión
session_start();

// Verificar si el usuario está autenticado
$response = [
    'loggedin' => isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true,
    'username' => isset($_SESSION['username']) ? $_SESSION['username'] : null,
    'role' => isset($_SESSION['role']) ? $_SESSION['role'] : null
];

// Devolver respuesta en formato JSON
header('Content-Type: application/json');
echo json_encode($response);
?>