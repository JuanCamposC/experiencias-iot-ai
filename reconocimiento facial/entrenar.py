import os
import cv2
import numpy as np

data_path = 'data'
people = os.listdir(data_path)

labels = []
faces = []
label = 0

for person in people:
    person_dir = os.path.join(data_path, person)
    for img_name in os.listdir(person_dir):
        img_path = os.path.join(person_dir, img_name)
        image = cv2.imread(img_path, 0)
        if image is not None:
            faces.append(image)
            labels.append(label)
    label += 1

print('Entrenando modelo...')
model = cv2.face.LBPHFaceRecognizer_create()
model.train(faces, np.array(labels))

os.makedirs('model', exist_ok=True)
model.save('model/lbph_model.xml')
print('Modelo guardado en model/lbph_model.xml')
