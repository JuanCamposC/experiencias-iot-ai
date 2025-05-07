<?php
include("db.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $temperatura = isset($_POST["temperatura"]) ? floatval($_POST["temperatura"]) : null;
    $humedad = isset($_POST["humedad"]) ? floatval($_POST["humedad"]) : null;

    if ($temperatura !== null && $humedad !== null) {
        $stmt = $conn->prepare("INSERT INTO datos_dht (temperatura, humedad) VALUES (?, ?)");
        $stmt->bind_param("dd", $temperatura, $humedad);

        if ($stmt->execute()) {
            echo "✅ Datos guardados correctamente.";
        } else {
            echo "❌ Error al insertar datos.";
        }

        $stmt->close();
    } else {
        echo "❌ Faltan datos.";
    }
} else {
    echo "❌ Petición inválida.";
}

$conn->close();
?>