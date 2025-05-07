import cv2
import os

def get_face_classifier():
    return cv2.CascadeClassifier(cv2.data.haarcascades + 'haarcascade_frontalface_default.xml')

def detect_faces(frame, classifier):
    gray = cv2.cvtColor(frame, cv2.COLOR_BGR2GRAY)
    faces = classifier.detectMultiScale(gray, 1.3, 5)
    return gray, faces

def save_face(rostro, path, count):
    cv2.imwrite(os.path.join(path, f'{count}.jpg'), rostro)
