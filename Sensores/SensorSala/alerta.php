<?php
// Asegúrate de recibir la temperatura en la solicitud
if (isset($_GET['temperatura'])) {
    $temperatura = $_GET['temperatura'];
} else {
    die("No se ha recibido temperatura.");
}

$token = "BOT_TOKEN"; // reemplaza con tu token
$chat_id = "CHAT_ID"; // tu chat o el de un grupo

// Formateamos el mensaje para incluir la temperatura
$mensaje = "🚨 ¡Alerta! La temperatura ha superado el límite crítico. La temperatura actual es: $temperatura °C";

// URL de la API de Telegram
$url = "https://api.telegram.org/bot$token/sendMessage";

// Configurar datos del mensaje
$data = [
    'chat_id' => $chat_id,
    'text' => $mensaje,
    'parse_mode' => 'Markdown' // opcional
];

// Inicializar cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// Ejecutar cURL
$response = curl_exec($ch);
curl_close($ch);

// Si se desea, mostrar la respuesta de Telegram
// echo $response;
?>
