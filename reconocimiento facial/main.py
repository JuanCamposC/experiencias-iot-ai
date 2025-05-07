import tkinter as tk
from tkinter import messagebox, simpledialog
import subprocess
import os
from PIL import Image, ImageTk
# Ruta al python del entorno virtual
PYTHON_VENV = os.path.join("venv", "Scripts", "python.exe")

# Funciones
def capturar_rostros():
    nombre = simpledialog.askstring("Nombre", "¿Cómo te llamas?",parent=ventana)
    if not nombre:
        messagebox.showerror("Error", "¡Debes ingresar un nombre!")
        return
    subprocess.run([PYTHON_VENV, "captura.py", nombre])

def entrenar_modelo():
    subprocess.run([PYTHON_VENV, "entrenar.py"])
    messagebox.showinfo("Entrenamiento", "¡Modelo entrenado correctamente!")

def reconocer_rostros():
    subprocess.run([PYTHON_VENV, "reconocer.py"])

# Interfaz
ventana = tk.Tk()
ventana.title("Reconocimiento Facial")
ventana.geometry("450x400")
ventana.config(bg="#005b83")

# Título
titulo = tk.Label(
    ventana,
    text="🎉 Bienvenido al Reconocimiento Facial 🎉",
    font=("Poppins", 16, "bold"),
    bg="#005b83",
    fg="#f2f2f2"
)
titulo.pack(pady=20)

# Botones
btn_captura = tk.Button(
    ventana, text="📸 Capturar Rostros",
    command=capturar_rostros,
    font=("Poppins", 14),
    bg="#AED6F1", width=25
)
btn_captura.pack(pady=10)

btn_entrenar = tk.Button(
    ventana, text="🤖 Entrenar Modelo",
    command=entrenar_modelo,
    font=("Poppins", 14),
    bg="#F9E79F", width=25
)
btn_entrenar.pack(pady=10)

btn_reconocer = tk.Button(
    ventana, text="🔍 Reconocer Rostros",
    command=reconocer_rostros,
    font=("Poppins", 14),
    bg="#A9DFBF", width=25
)
btn_reconocer.pack(pady=10)

# Cargar y mostrar el logo
try:
    logo = Image.open("logo-unab2.png")
    logo = logo.resize((100, 100))  # Ajusta el tamaño si es necesario
    logo_tk = ImageTk.PhotoImage(logo)
    logo_label = tk.Label(ventana, image=logo_tk, bg="#005b83")
    logo_label.image = logo_tk  # Evitar que se elimine por el recolector de basura
    logo_label.pack(pady=20)
except Exception as e:
    print("No se pudo cargar el logo:", e)



ventana.mainloop()
