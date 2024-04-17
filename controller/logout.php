<?php
session_start();

// Destruir todas las variables de sesión
$_SESSION = array();

// Eliminar la cookie de sesión si está configurada
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
}

// Destruir la sesión
session_destroy();

// Redirigir a la página de inicio
header("location:../index.html");
exit();
?>