<?php
session_start();
// Verificar si la sesión no está iniciada
if (!isset($_SESSION["username"])) {
    // Mostrar un alert y redirigir utilizando JavaScript 
    echo '<script>alert("Debes iniciar sesión antes de acceder.");</script>';
    echo '<script>window.location.href = "../../iniciar_sesion.php";</script>';
    exit();
}

// Incluir el archivo de conexión
require_once("../../conexion/conexion.php");

// Crear una instancia de la clase Database
$db = new Database();

// Obtener la conexión
$con = $db->getConnection();
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php include("nav.php") ?>
</body>
</html>