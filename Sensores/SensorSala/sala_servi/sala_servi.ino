#include <ESP8266WiFi.h>
#include <DHT.h>
#include <ESP8266HTTPClient.h>

#define DHTPIN 4        // GPIO2 (D2 en algunas placas)
#define DHTTYPE DHT11

DHT dht(DHTPIN, DHTTYPE);

// Credenciales WiFi
const char* ssid = "iPhone de Juan";
const char* password = "hola12345";

// Servidor para enviar datos
const char* serverName = "http://sensores.lacasadedios.cl/api.php";

// Rangos óptimos
float tempMin = 18.0;
float tempMax = 28.0;
float humMin = 45.0;
float humMax = 70.0;

void setup() {
  Serial.begin(9600);
  dht.begin();

  WiFi.begin(ssid, password);
  Serial.print("Conectando a WiFi");

  while (WiFi.status() != WL_CONNECTED) {
    delay(1000);
    Serial.print(".");
  }

  Serial.println("\n✅ Conectado a WiFi");
}

void loop() {
  // Verifica conexión WiFi
  if (WiFi.status() != WL_CONNECTED) {
    Serial.println("⚠️ WiFi desconectado. Reconectando...");
    WiFi.begin(ssid, password);
    delay(5000);
    return;
  }

  float temperatura = dht.readTemperature();
  float humedad = dht.readHumidity();

  if (isnan(temperatura) || isnan(humedad)) {
    Serial.println("❌ Error al leer DHT11");
    delay(10000);
    return;
  }

  Serial.println("🌡️ Temp: " + String(temperatura) + "°C");
  Serial.println("💧 Humedad: " + String(humedad) + "%");

  // Enviar datos al servidor
  WiFiClient client;
  HTTPClient http;
  http.setTimeout(10000);
  http.begin(client, serverName);
  http.addHeader("Content-Type", "application/x-www-form-urlencoded");

  String datos = "temperatura=" + String(temperatura, 1) +
                 "&humedad=" + String(humedad, 1);

  int httpCode = http.POST(datos);

  if (httpCode > 0) {
    Serial.println("✅ Datos enviados correctamente.");
    String respuesta = http.getString();
    Serial.println("🔁 Respuesta: " + respuesta);
  } else {
    Serial.println("❌ Error al enviar datos.");
    Serial.println("🔢 Código HTTP: " + String(httpCode));
  }

  http.end();

  // Verifica si se sale del rango óptimo
  if (temperatura < tempMin || temperatura > tempMax ||
      humedad < humMin || humedad > humMax) {
    Serial.println("🚨 *Alerta de ambiente crítico* 🚨");
  }

  delay(30000); // Espera 30 segundos
}