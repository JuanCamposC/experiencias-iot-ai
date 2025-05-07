<?php
$host = "localhost";
$usuario = "sensor";
$contrasena = "Limache1695&";
$base_datos = "sensores";

$conn = new mysqli($host, $usuario, $contrasena, $base_datos);

if ($conn->connect_error) {
    die("❌ Error de conexión: " . $conn->connect_error);
}
?>
