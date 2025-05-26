# 🤖 Experiencias con IA, Visión por Computador y Sensores IoT

> **⚠️ IMPORTANTE: Versión de Python Requerida**
> Este proyecto fue desarrollado y probado íntegramente con **Python 3.11.0**. Para asegurar la correcta ejecución y compatibilidad con todas las librerías, es crucial utilizar esta versión específica.

Este repositorio agrupa tres experiencias prácticas desarrolladas con Python y tecnologías de inteligencia artificial e IoT. Cada proyecto está contenido en su propia carpeta e incluye código, dependencias y estructura organizada para su ejecución.

## 📁 Estructura del repositorio

```
experiencias-iot-ai/
├── reconocimiento facial/
├── reconocimiento de mano/
├── Sensores/
│   ├── SensorHumedad/
│   └── SensorSala/
├── README.md
└── .gitignore
```

---

## 🔍 Descripción de cada proyecto

### 1. Reconocimiento Facial (`reconocimiento facial/`)

Un sistema de reconocimiento facial simple utilizando OpenCV.

- `captura.py`: captura imágenes de rostros
- `entrenar.py`: entrena el modelo LBPH
- `logo-unab2.png`: imagen decorativa institucional
- `main.py`: lanzador del sistema
- `reconocer.py`: reconocimiento facial en tiempo real
- `reconocimiento.bat`: script para ejecutar el sistema con entorno virtual
- `requirements.txt`: dependencias necesarias
- `unab.ico`: icono de la aplicación
- `utils.py`: funciones de utilidad
- `data/`: almacena fotos capturadas
- `model/`: almacena el modelo entrenado

> ⚠️ **Nota:** El entorno virtual (`venv/`) no se incluye en el repositorio. Se debe crear manualmente y activar antes de instalar los paquetes.

---

### 2. Reconocimiento de Mano (`reconocimiento de mano/`)

Un sistema que detecta la presencia de una mano usando MediaPipe y OpenCV.

- `controller.py`: lógica de detección
- `hello.py`: ejemplo de ejecución
- `requirements.txt`: dependencias necesarias

> ⚠️ **Nota:** El entorno virtual (`recono/`) tampoco se incluye. Debe ser creado localmente.

---

### 3. Sensores (`Sensores/`)

Contiene dos subproyectos con sensores IoT basados en ESP8266:

#### 🖥️ `SensorSala/`

Sensor de temperatura y humedad (DHT11) conectado a un ESP8266. Los datos se envían a una base de datos mediante una API, y se visualizan en una página web.

#### 🌱 `humedad-planta/`

Sensor de humedad de suelo conectado a un ESP8266. El dispositivo se comunica con un bot de Telegram para enviar alertas al usuario. (Corresponde a la carpeta `SensorHumedad/`)

> ⚠️ **IMPORTANTE:**  
> - **Token del bot de Telegram**: Debes reemplazar la constante o variable del token en el código con tu propio token de bot (ej. en `Sensores/SensorHumedad/SensorHumedad.ino`).
> - **Red Wi-Fi**: Cambia el `SSID` y `PASSWORD` en los archivos `.ino` o `.py` según la red Wi-Fi a la que se conectará tu ESP8266.
> - **API URL o IP**: Si usas un servidor local o en la nube para `SensorSala/`, asegúrate de modificar la URL a donde se envían los datos en los archivos correspondientes (ej. `api.php`).

---

## 🔧 Instrucciones generales (para reconocimiento facial y de mano)

### 1. Crear un entorno virtual

```bash
python -m venv venv
```

### 2. Activar el entorno

- **Windows**:

```bash
venv\Scripts\activate
```

- **Linux/Mac**:

```bash
source venv/bin/activate
```

### 3. Instalar dependencias

Para cada proyecto que tenga un archivo `requirements.txt` navega a su directorio y ejecuta:
```bash
pip install -r requirements.txt 
```

---

## 📝 Notas adicionales

- Se recomienda usar `pythonw` o archivos `.bat` para ejecutar interfaces sin consola visible, especialmente en Windows.
- Puedes adaptar estos proyectos según tus necesidades, modificando el código y las configuraciones de hardware y software pertinentes.

---

## 👨‍💻 Autor

Proyecto desarrollado por Juan Campos Castro estudiante de Ingeniería en Computación e Informática — Universidad Andrés Bello (UNAB), 2025.

---
