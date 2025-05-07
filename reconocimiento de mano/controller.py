import pyfirmata2

comport = 'COM9'
board = pyfirmata2.Arduino(comport)

led_1 = board.get_pin('d:2:o')  # LED para dedo 1
led_2 = board.get_pin('d:4:o')  # LED para dedo 2
led_3 = board.get_pin('d:6:o')  # LED para dedo 3
led_4 = board.get_pin('d:8:o')  # LED para dedo 4
led_5 = board.get_pin('d:11:o') # LED para dedo 5

def led(fingerUp):
    led_1.write(fingerUp[0])  # LED 1 -> Dedo 1
    led_2.write(fingerUp[1])  # LED 2 -> Dedo 2
    led_3.write(fingerUp[2])  # LED 3 -> Dedo 3
    led_4.write(fingerUp[3])  # LED 4 -> Dedo 4
    led_5.write(fingerUp[4])  # LED 5 -> Dedo 5