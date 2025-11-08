import cv2
import socket
import numpy as np

ancho, alto= 800, 600
fondo = np.ones((alto,ancho,3), dtype=np.uint8) * 255 

ipesp32 = "192.168.100.28"
puerto = 8888
servidor= socket.socket(socket.AF_INET, socket.SOCK_STREAM)
servidor.connect((ipesp32,puerto))
lista =[]
while True:
    try:
        dato = servidor.recv(1024).decode().strip()
        if not dato:
            continue
        print(dato)
        fondo = np.ones((alto,ancho,3), dtype=np.uint8) * 255
        cv2.putText(fondo, str(dato), (ancho//2,(alto//2)-100),cv2.FONT_HERSHEY_SIMPLEX, 0.7, (0,0,0),2) 
        lista.append(dato)
        cv2.imshow("Valores desde ESPROA", fondo)
        #if len(lista)>=10:
            #break
        key = cv2.waitKey(25) & 0xFF 
        if  key == ord('q'):
            break
    
    except Exception as e:
        print("Error",e)
        
servidor.close()
cv2.destroyAllWindows()