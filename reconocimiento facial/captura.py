import cv2
import os
import imutils
import sys
from utils import get_face_classifier, detect_faces, save_face

# Recibe el nombre desde argumentos
person_name = sys.argv[1].strip()
data_path = 'data'
person_path = os.path.join(data_path, person_name)

os.makedirs(person_path, exist_ok=True)
print(f'Guardando rostros en: {person_path}')

cap = cv2.VideoCapture(0, cv2.CAP_DSHOW) # 0 es la cámara por defecto, camara 1 es la segunda cámara
face_classifier = get_face_classifier()
count = 0

while True:
    ret, frame = cap.read()
    if not ret: break

    frame = imutils.resize(frame, width=640)
    gray, faces = detect_faces(frame, face_classifier)

    for (x, y, w, h) in faces:
        rostro = gray[y:y+h, x:x+w]
        rostro = cv2.resize(rostro, (150, 150))
        save_face(rostro, person_path, count)
        count += 1

        cv2.rectangle(frame, (x,y), (x+w, y+h), (0,255,0), 2)

    cv2.imshow('Captura de Rostros', frame)
    if cv2.waitKey(1) == 27 or count >= 300: break

cap.release()
cv2.destroyAllWindows()
