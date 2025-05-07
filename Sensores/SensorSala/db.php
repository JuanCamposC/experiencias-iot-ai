<?php
$host = "HOST"; // Cambia esto por la dirección IP o nombre de host de tu servidor MySQL
$usuario = "USER"; // Cambia esto por tu nombre de usuario de MySQL
$contrasena = "CONTRASENA"; // Cambia esto por tu contraseña de MySQL
$base_datos = "BASE_DE_DATOS"; // Cambia esto por el nombre de tu base de datos

$conn = new mysqli($host, $usuario, $contrasena, $base_datos);

if ($conn->connect_error) {
    die("❌ Error de conexión: " . $conn->connect_error);
}
?>
