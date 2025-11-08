import serial
import time

def leer():
    n = 0
    while(True):
        datos = conexion.readline().strip()
        if datos != "":
            lista.append(datos)
            print(lista)
        n += 1
        
        if n > 100:
            break
        time.sleep(0.1)


lista = []
conexion = serial.Serial('COM4',115200,timeout=1)
if __name__=='__main__':
    leer()
    conexion.close()