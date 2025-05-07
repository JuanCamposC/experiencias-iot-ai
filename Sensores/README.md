# Proyectos de Sensores IoT con ESP8266

Esta carpeta contiene dos subproyectos que utilizan el microcontrolador ESP8266 para interactuar con sensores y servicios externos.

## 📂 Estructura de Archivos

```
Sensores/
├── SensorHumedad/
│   └── SensorHumedad.ino  # Código para el sensor de humedad de suelo y bot de Telegram
├── SensorSala/
│   ├── alerta.php         # Script PHP para manejar alertas (posiblemente no usado directamente por ESP)
│   ├── api.php            # Endpoint API para recibir datos del sensor de sala
│   ├── datos.php          # Script PHP para mostrar datos (posiblemente en una web)
│   ├── db.php             # Script PHP para la conexión a la base de datos
│   ├── index.php          # Página principal para visualizar datos del sensor de sala
│   └── sala_servi/
│       └── sala_servi.ino # Código para el sensor de temperatura/humedad (DHT11)
└── README.md              # Este archivo
```

## 🌡️ Sensor de Sala (`SensorSala/`)

### 📜 Descripción

Este proyecto utiliza un sensor de temperatura y humedad DHT11 conectado a un ESP8266. El ESP8266 lee los datos del sensor y los envía a una API web (implementada en PHP en este caso) que los almacena en una base de datos. Los datos pueden ser visualizados en una página web.

### 🔌 Componentes

- ESP8266
- Sensor de temperatura y humedad DHT11
- Servidor web con PHP y una base de datos (ej. MySQL/MariaDB) para la API y visualización.

### ⚙️ Configuración y Uso (ESP8266 - `sala_servi.ino`)

1.  **Abrir en Arduino IDE**: Abre el archivo `Sensores/SensorSala/sala_servi/sala_servi.ino` con el Arduino IDE.
2.  **Instalar Bibliotecas**: Necesitarás las bibliotecas para el ESP8266 y el sensor DHT.
    - `ESP8266WiFi.h`
    - `DHT.h` (de Adafruit o similar)
    - `ArduinoHttpClient.h` (o la que uses para peticiones HTTP)
    Puedes instalarlas desde el Gestor de Bibliotecas del Arduino IDE.
3.  **Configurar Wi-Fi**: Modifica las siguientes líneas en `sala_servi.ino` con tus credenciales de Wi-Fi:
    ```cpp
    const char* ssid = "TU_SSID";
    const char* password = "TU_PASSWORD";
    ```
4.  **Configurar Endpoint de la API**: Modifica la URL del servidor donde se encuentra tu `api.php`:
    ```cpp
    String serverName = "http://TU_SERVIDOR_IP_O_DOMINIO/ruta/a/api.php";
    ```
5.  **Conexiones del Sensor**: Conecta el sensor DHT11 al ESP8266 según el pin definido en el código (por defecto `DHTPIN 2`).
6.  **Subir el Código**: Selecciona la placa ESP8266 correcta y el puerto COM, luego sube el sketch.

### 🌐 Configuración y Uso (Servidor Web - PHP)

1.  **Base de Datos**: 
    - Configura una base de datos (ej. MySQL).
    - Crea una tabla para almacenar los datos de temperatura y humedad (ej. `CREATE TABLE lecturas (id INT AUTO_INCREMENT PRIMARY KEY, temperatura FLOAT, humedad FLOAT, timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP);`).
    - Actualiza los detalles de conexión a la base de datos en `db.php`.
2.  **Subir Archivos PHP**: Sube los archivos `api.php`, `datos.php`, `db.php`, y `index.php` a tu servidor web en la ruta que configuraste en el ESP8266.
3.  **Probar**: 
    - El ESP8266 debería empezar a enviar datos a `api.php`.
    - Accede a `index.php` en tu navegador para ver los datos.

## 🌱 Sensor de Humedad de Planta (`SensorHumedad/`)

### 📜 Descripción

Este proyecto utiliza un sensor de humedad de suelo conectado a un ESP8266. Cuando la humedad del suelo baja de cierto umbral (indicando que la planta necesita agua), el ESP8266 envía una notificación a un bot de Telegram.

### 🔌 Componentes

- ESP8266
- Sensor de humedad de suelo (analógico)
- Conexión a Internet para el ESP8266
- Un bot de Telegram y su token.

### ⚙️ Configuración y Uso (`SensorHumedad.ino`)

1.  **Abrir en Arduino IDE**: Abre el archivo `Sensores/SensorHumedad/SensorHumedad.ino`.
2.  **Instalar Bibliotecas**:
    - `ESP8266WiFi.h`
    - `UniversalTelegramBot.h` (o la biblioteca que prefieras para Telegram)
    Puedes instalarlas desde el Gestor de Bibliotecas.
3.  **Configurar Wi-Fi**: Modifica las siguientes líneas con tus credenciales:
    ```cpp
    char ssid[] = "TU_SSID";
    char pass[] = "TU_PASSWORD";
    ```
4.  **Configurar Bot de Telegram**:
    - Crea un bot de Telegram hablando con `BotFather` y obtén tu **token**.
    - Obtén tu **Chat ID** (puedes usar bots como `@RawDataBot` o `@userinfobot` enviándoles un mensaje).
    - Modifica estas líneas en el código:
      ```cpp
      #define BOTtoken "TU_TOKEN_DE_BOT"
      #define CHAT_ID "TU_CHAT_ID"
      ```
5.  **Conexiones del Sensor**: Conecta el sensor de humedad de suelo al pin analógico A0 del ESP8266 (o al que definas).
6.  **Ajustar Umbral**: Modifica el valor de `umbralHumedad` si es necesario, según las lecturas de tu sensor y las necesidades de tu planta.
    ```cpp
    int umbralHumedad = 500; // Ajusta este valor
    ```
7.  **Subir el Código**: Selecciona la placa ESP8266 y el puerto COM, luego sube el sketch.

## ⚠️ Notas Generales

- Para ambos proyectos `.ino`, necesitarás tener el Arduino IDE configurado para programar placas ESP8266. Esto usualmente implica añadir la URL del gestor de tarjetas ESP8266 en las preferencias del IDE e instalar el paquete ESP8266 desde el Gestor de Tarjetas.
- Asegúrate de que el ESP8266 tenga una fuente de alimentación adecuada.
- Los valores de los sensores (especialmente el de humedad de suelo) pueden variar. Calibra o ajusta los umbrales según sea necesario.
