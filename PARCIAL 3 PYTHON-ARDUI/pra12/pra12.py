# -*- coding: utf-8 -*-
"""
Created on Tue Nov  4 11:42:08 2025

@author: Absja
"""

import cv2 
import matplotlib.pyplot as plt
import json
import serial
from collections import deque
import numpy as np
aux = 0
puerto = serial.Serial("COM4",115200, timeout=1)

transmitiendo = False
ancho, alto = 800,600

valor1 = deque(maxlen=100)
valor2 = deque(maxlen=100)

plt.ioff()#desactivar modo iteractivo de ventana

fig, (x1,x2) = plt.subplots(2,1, figsize=(8,6))
fig.subplots_adjust(hspace=0.4)


x1.set_title("Valor 1")
x1.set_ylim(0,100)
x1.set_xlim(0,100)
x1.set_ylabel("Valores")
x1.grid(True)

x2.set_title("Valor 1")
x2.set_ylim(0,100)
x2.set_xlim(0,100)
x2.set_ylabel("Valores")
x2.grid(True)

linea1, = x1.plot([],[], color = 'red', linewidth=2)#grafico lineal
linea2, = x2.plot([],[], color = 'blue', linewidth=2)#grafico lineal

fondo = np.ones((alto,ancho,3), dtype = np.uint8) * 255

texto = "Presiona j inicia el grafico, con o se detiene el trafico, con q termina"

cv2.putText(fondo, texto, (50,alto//2),cv2.FONT_HERSHEY_SIMPLEX,0.7,(0,0,0),2)
cv2.imshow("Graficas valores", fondo)


while True:
    key = cv2.waitKey(25) & 0xFF
    
    if key == ord('j'):
        transmitiendo = True
        puerto.write(b'1')#b de processing
        
    if key == ord('o'):
        transmitiendo = False
        puerto.write(b'1')
        
    if key == ord('q'):
        break
    
    if transmitiendo and puerto.in_waiting:#escucha
        try:
            dato = puerto.readline().decode().strip()
            if not dato:
                continue
            datos = json.loads(dato)
            if not isinstance(datos,dict) or "values" not in datos:
                continue
            valores = datos.get("values",[])
            if not isinstance(valores, (list,tuple)) or len(valores) != 2:#2 datos
                continue
            
            v1,v2 = valores
            
            valor1.append(v1)
            valor2.append(v2)
            
            linea1.set_data(range(len(valor1)), list(valor1))
            linea2.set_data(range(len(valor2)), list(valor2))
            
            fig.canvas.draw()
            
            img = np.array(fig.canvas.buffer_rgba())
            img = cv2.cvtColor(img, cv2.COLOR_RGB2BGR)
            img = cv2.resize(img,(ancho,alto))
            
            cv2.imshow("Graficas valores", img)
            
        except Exception as e:
            print('Error',e)
            continue
        except json.JSONDecodeError:
            print('Error de json')
    elif not transmitiendo:
        cv2.imshow("Graficas valores", fondo)
        
        
puerto.close()
cv2.destroyAllWindows()
