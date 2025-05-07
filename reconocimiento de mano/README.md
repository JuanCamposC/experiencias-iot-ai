# Reconocimiento de Mano con MediaPipe y OpenCV

Este proyecto utiliza las bibliotecas MediaPipe y OpenCV para detectar la presencia y los puntos de referencia de una mano en tiempo real a través de una cámara web.

## 📜 Descripción

El sistema se centra en la detección de manos. El script `controller.py` contiene la lógica principal para inicializar la cámara, utilizar el modelo de detección de manos de MediaPipe y dibujar los puntos de referencia (landmarks) y las conexiones entre ellos sobre la imagen capturada. El archivo `hello.py` sirve como un ejemplo básico para ejecutar el detector.

## 📂 Estructura de Archivos

```
reconocimiento de mano/
├── controller.py        # Lógica principal de detección de manos
├── hello.py             # Script de ejemplo para ejecutar la detección
├── requirements.txt     # Dependencias del proyecto
├── recono/                # Carpeta del entorno virtual (no incluida en el repo)
├── __pycache__/         # Carpeta de caché de Python (no incluida en el repo)
└── README.md            # Este archivo
```

## ⚙️ Configuración y Uso

### 1. Prerrequisitos

- Python 3.x
- pip (manejador de paquetes de Python)

### 2. Crear un Entorno Virtual

Se recomienda crear un entorno virtual. Si ya tienes la carpeta `venv/` de un uso anterior, puedes activarla. Si no, créala:

```bash
python -m venv venv
```

### 3. Activar el Entorno Virtual

- **Windows**:
  ```bash
  venv\Scripts\activate
  ```
- **Linux/Mac**:
  ```bash
  source venv/bin/activate
  ```

### 4. Instalar Dependencias

Con el entorno virtual activado, instala las bibliotecas necesarias:

```bash
pip install -r requirements.txt
```
Las principales dependencias son `opencv-python`, `mediapipe` y `cvzone`.

### 5. Ejecutar la Detección

Para iniciar la detección de manos, ejecuta el script `hello.py`:

```bash
python hello.py
```

Esto abrirá una ventana mostrando la imagen de la cámara. Si una mano es visible, se dibujarán sobre ella los puntos de referencia y las conexiones.

## 📝 Notas

- Asegúrate de tener una cámara web conectada y funcionando.
- MediaPipe descargará automáticamente los modelos necesarios la primera vez que se ejecute.
