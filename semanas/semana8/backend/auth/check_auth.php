<?php
// Iniciar sesión si no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Función para verificar si el usuario está autenticado
function isLoggedIn() {
    return isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
}

// Función para redirigir si no está autenticado
function requireLogin() {
    if (!isLoggedIn()) {
        // Guardar la URL actual para redirigir después del login
        $_SESSION['redirect_after_login'] = $_SERVER['REQUEST_URI'];
        
        // Redirigir al login
        header("Location: ../../frontend/login.html?error=auth_required");
        exit;
    }
}

// Función para verificar si el usuario tiene un rol específico
function hasRole($role) {
    return isLoggedIn() && isset($_SESSION['role']) && $_SESSION['role'] === $role;
}

// Función para obtener el nombre de usuario actual
function getCurrentUsername() {
    return isLoggedIn() ? $_SESSION['username'] : null;
}

// Función para obtener el ID del usuario actual
function getCurrentUserId() {
    return isLoggedIn() ? $_SESSION['user_id'] : null;
}
?>