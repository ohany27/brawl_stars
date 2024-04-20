<?php
// Establecer la conexión a la base de datos
$servername = "localhost";
$database = "brawl_stars";
$username = "root";
$password = "";

try {
    $con = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    // Establecer el modo de error de PDO a excepción
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    // Si hay un error en la conexión, muestra un mensaje de error
    echo "Error de conexión: " . $e->getMessage();
}
?>

