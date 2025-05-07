#include <ESP8266WiFi.h>
#include <WiFiClientSecure.h>
#include <UniversalTelegramBot.h>

// WiFi
const char* ssid = "NOMBRESSID"; // Reemplazar con el nombre de tu red WiFi
const char* password = "CONTRASEÑA"; // Reemplazar con la contraseña de tu red WiFi

// Telegram
#define BOT_TOKEN "BOT_TOKEN" // Reemplazar con el token de tu bot
WiFiClientSecure client;
UniversalTelegramBot bot(BOT_TOKEN, client);

// Sensor de humedad
const int sensorPin = A0;

// Chequeo periódico de mensajes
unsigned long lastCheck = 0;
const unsigned long interval = 2000; // cada 2 segundos

void setup() {
  Serial.begin(115200);
  pinMode(sensorPin, INPUT);

  // Conexión WiFi
  WiFi.begin(ssid, password);
  Serial.print("Conectando a WiFi");
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("\n✅ Conectado a WiFi");
  Serial.println(WiFi.localIP());

  client.setInsecure(); // evitar problemas de certificado SSL
}

void loop() {
  if (millis() - lastCheck > interval) {
    int mensajesNuevos = bot.getUpdates(bot.last_message_received + 1);

    while (mensajesNuevos) {
      manejarMensajes(mensajesNuevos);
      mensajesNuevos = bot.getUpdates(bot.last_message_received + 1);
    }

    lastCheck = millis();
  }
}

void manejarMensajes(int numMensajes) {
  for (int i = 0; i < numMensajes; i++) {
    String texto = bot.messages[i].text;
    String chat_id = bot.messages[i].chat_id;
    String nombre = bot.messages[i].from_name;

    if (texto == "/start") {
      String bienvenida = "🌿 ¡Hola, *" + nombre + "*!\n"
                          "Soy un bot que monitorea al Bulbasaur y *humedad de su planta*.\n"
                          "Usa el comando /humedad para saber el estado actual.";
      bot.sendMessage(chat_id, bienvenida, "Markdown");
    }

    if (texto == "/humedad" || texto == "/humedad@FIUNABVINA_BOT") {
      int valorSensor = analogRead(sensorPin);
      int humedad = map(valorSensor, 1023, 300, 0, 100);
      humedad = constrain(humedad, 0, 100);

      String estado;
      if (humedad >= 60) {
        estado = "🟢 *La pkanta de Bulbasaur está en óptimas condiciones*";
      } else if (humedad >= 30) {
        estado = "🟡 *Considera regar pronto, Bulbasaur tiene sed*";
      } else {
        estado = "🔴 *La planta está seca, Bulbasaur necesita agua*";
      }

      String respuesta = "📊 *Humedad de la planta*: *" + String(humedad) + "%*\n" + estado;
      bot.sendMessage(chat_id, respuesta, "Markdown");
    }
  }
}
