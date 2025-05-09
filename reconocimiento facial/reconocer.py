import cv2
import os
from utils import get_face_classifier, detect_faces

data_path = 'data'
people = os.listdir(data_path)
model = cv2.face.LBPHFaceRecognizer_create()
model.read('model/lbph_model.xml')

cap = cv2.VideoCapture(0, cv2.CAP_DSHOW) # 0 es la cámara por defecto, camara 1 es la segunda cámara
face_classifier = get_face_classifier()

while True:
    ret, frame = cap.read()
    if not ret: break

    gray, faces = detect_faces(frame, face_classifier)

    for (x, y, w, h) in faces:
        rostro = gray[y:y+h, x:x+w]
        rostro = cv2.resize(rostro, (150, 150))
        label, confidence = model.predict(rostro)

        if confidence < 70:
            name = people[label]
            color = (0, 255, 0)
        else:
            name = 'Desconocido'
            color = (0, 0, 255)

        cv2.putText(frame, f'{name} ({round(confidence, 2)})', (x, y - 10), 2, 0.8, color, 1)
        cv2.rectangle(frame, (x, y), (x + w, y + h), color, 2)

    cv2.imshow('Reconocimiento Facial', frame)
    if cv2.waitKey(1) == 27:
        break

cap.release()
cv2.destroyAllWindows()
