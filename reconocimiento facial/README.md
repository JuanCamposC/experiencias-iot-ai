# Reconocimiento Facial con OpenCV

Este proyecto implementa un sistema de reconocimiento facial básico utilizando la biblioteca OpenCV en Python.

## 📜 Descripción

El sistema consta de tres componentes principales:
1.  **Captura de Rostros (`captura.py`)**: Toma fotografías del usuario y las almacena en la carpeta `data/` asociadas a un ID.
2.  **Entrenamiento del Modelo (`entrenar.py`)**: Utiliza las imágenes capturadas para entrenar un modelo de reconocimiento facial (LBPH - Local Binary Patterns Histograms). El modelo entrenado se guarda en la carpeta `model/`.
3.  **Reconocimiento Facial (`reconocer.py`)**: Utiliza la cámara para detectar rostros en tiempo real y los compara con el modelo entrenado para identificar a las personas.

El archivo `main.py` sirve como lanzador para acceder a estas funcionalidades y `utils.py` contiene funciones auxiliares.

## 📂 Estructura de Archivos

```
reconocimiento facial/
├── captura.py           # Script para capturar rostros
├── entrenar.py          # Script para entrenar el modelo
├── logo-unab2.png       # Logo institucional
├── main.py              # Script principal para ejecutar el sistema
├── reconocer.py         # Script para el reconocimiento en tiempo real
├── reconocimiento.bat   # Script batch para ejecutar main.py (Windows)
├── requirements.txt     # Dependencias del proyecto
├── unab.ico             # Icono de la aplicación
├── utils.py             # Funciones de utilidad
├── data/                  # Carpeta para almacenar las imágenes de rostros capturadas
├── model/                 # Carpeta para almacenar el modelo entrenado
└── README.md            # Este archivo
```

## ⚙️ Configuración y Uso

### 1. Prerrequisitos

- Python 3.x
- pip (manejador de paquetes de Python)

### 2. Crear un Entorno Virtual

Es altamente recomendable crear un entorno virtual para aislar las dependencias del proyecto.

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
Las principales dependencias son `opencv-python` y `numpy`.

### 5. Ejecutar el Sistema

Puedes ejecutar el sistema utilizando el script principal `main.py` o el archivo batch `reconocimiento.bat` en Windows.

- **Usando Python**:
  ```bash
  python main.py
  ```
- **Usando el archivo batch (Windows)**:
  Doble clic en `reconocimiento.bat` o ejecútalo desde la consola:
  ```bash
  reconocimiento.bat
  ```

### 📋 Pasos de Uso del Sistema

1.  **Capturar Rostros**:
    *   Ejecuta `main.py` y selecciona la opción para capturar rostros.
    *   Ingresa un ID numérico para la persona.
    *   El sistema tomará varias fotos. Asegúrate de mover ligeramente la cabeza para capturar diferentes ángulos.
2.  **Entrenar Modelo**:
    *   Una vez que tengas suficientes imágenes (idealmente de varias personas), selecciona la opción para entrenar el modelo.
    *   El script `entrenar.py` procesará las imágenes en `data/` y guardará el archivo `modeloLBPH.xml` en la carpeta `model/`.
3.  **Reconocer Rostros**:
    *   Selecciona la opción de reconocimiento.
    *   El sistema activará la cámara y tratará de identificar los rostros detectados basándose en el modelo entrenado.

## 📝 Notas

- Asegúrate de tener una cámara web conectada y funcionando.
- La calidad del reconocimiento dependerá de la calidad y cantidad de las imágenes de entrenamiento.
- La carpeta `__pycache__/` es generada automáticamente por Python y no necesita ser incluida en el control de versiones (generalmente se añade al `.gitignore`).
