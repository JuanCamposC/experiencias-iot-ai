<?php
include("db.php");

// Datos del DHT11
$resDHT = $conn->query("SELECT temperatura, humedad, fecha FROM datos_dht ORDER BY id DESC LIMIT 20");
$dataDHT = [];

while ($fila = $resDHT->fetch_assoc()) {
    $dataDHT[] = $fila;
}

$conn->close();

echo json_encode([
    "dht" => array_reverse($dataDHT),
]);
?>
