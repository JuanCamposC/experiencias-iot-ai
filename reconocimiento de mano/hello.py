import cv2
import controller as cnt
from cvzone.HandTrackingModule import HandDetector

detector = HandDetector(detectionCon=0.8, maxHands=1)

video = cv2.VideoCapture(0)

while True:
    ret, frame = video.read()
    frame = cv2.flip(frame, 1)
    hands, img = detector.findHands(frame)
    
    if hands:
        lmList = hands[0]
        fingerUp = detector.fingersUp(lmList)

        if sum(fingerUp) > 5:
            fingerUp = [0, 0, 0, 0, 0]

        print(fingerUp)
        cnt.led(fingerUp)
        count_fingers = sum(fingerUp)
        cv2.putText(frame, f'{count_fingers} dedos arriba', (20, 460), cv2.FONT_HERSHEY_PLAIN, 3, (255, 0, 0), 3)
    
    cv2.imshow("frame", frame)
    k = cv2.waitKey(1)
    if k == ord("k"):
        break

video.release()
cv2.destroyAllWindows()