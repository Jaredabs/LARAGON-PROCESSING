# -*- coding: utf-8 -*-
"""
Created on Tue Nov  4 13:34:40 2025

@author: Absja
"""

import cv2 
import matplotlib.pyplot as plt
import json
import serial
from collections import deque
import numpy as np


puerto = serial.Serial("COM6", 115200, timeout=1) 

transmitiendo = False

ancho, alto = 1200, 600 

valor1 = deque(maxlen=100)
valor2 = deque(maxlen=100)

plt.ioff() # desactivar modo iteractivo de ventana


fig, (ax1, ax2, ax3) = plt.subplots(1, 3, figsize=(12, 6))
fig.subplots_adjust(hspace=0.4, wspace=0.3) # Ajustar espacio


ax1.set_title("Valor 1")
ax1.set_ylim(0, 100)
ax1.set_xlim(0, 100)
ax1.set_xlabel("Valores")
ax1.grid(True)
linea1, = ax1.plot([], [], color='red', linewidth=2)


ax2.set_title("Valor 2")
ax2.set_ylim(0, 100)
ax2.set_xlim(0, 100)
ax2.set_xlabel("Valores")
ax2.grid(True)
linea2, = ax2.plot([], [], color='blue', linewidth=2)


ax3.set_title("Valores")
ax3.set_ylim(0, 100)
ax3.set_xlabel("Sensor")
ax3.set_ylabel("Valores")
ax3.grid(True)



fondo = np.ones((alto, ancho, 3), dtype=np.uint8) * 255
texto = "Presiona j inicia el grafico, con o se detiene el trafico, con q termina"
cv2.putText(fondo, texto, (50, alto // 2), cv2.FONT_HERSHEY_SIMPLEX, 0.7, (0, 0, 0), 2)
cv2.imshow("Graficas valores", fondo)

while True:
    key = cv2.waitKey(25) & 0xFF
    
    if key == ord('j'):
        transmitiendo = True
        puerto.write(b'1')
        
    if key == ord('o'):
        transmitiendo = False
        puerto.write(b'1')
        
    if key == ord('q'):
        break
    
    if transmitiendo and puerto.in_waiting:
        try:
            dato = puerto.readline().decode().strip()
            if not dato:
                continue
            
            datos = json.loads(dato)
            
            if not isinstance(datos, dict) or "values" not in datos or "labels" not in datos:
                continue
                
            valores = datos.get("values", [])
            labels = datos.get("labels", []) 
            
            if not isinstance(valores, list) or len(valores) != 2:
                continue
            
            v1, v2 = valores
            
          
            valor1.append(v1)
            valor2.append(v2)
            linea1.set_data(range(len(valor1)), list(valor1))
            linea2.set_data(range(len(valor2)), list(valor2))
            
           
            ax3.clear() 
          
            ax3.set_title("Valores Actuales")
            ax3.set_ylim(0, 100) # Límite de 0 a 100
            ax3.set_xlabel("Sensor")
            ax3.set_ylabel("Valores")
            ax3.grid(True)
            
            barras = ax3.bar(labels, valores, color=['red', 'blue'])
            
          
            for i, barra in enumerate(barras):
                valor_actual = valores[i]
                ax3.text(barra.get_x() + barra.get_width() / 2,
                         valor_actual + 1, # Un poco encima de la barra
                         str(valor_actual),
                         ha='center', va='bottom', fontsize=10)
            
          
            fig.canvas.draw()
            
           
            img = np.array(fig.canvas.buffer_rgba())
            img = cv2.cvtColor(img, cv2.COLOR_RGB2BGR)
            img = cv2.resize(img, (ancho, alto))
            
            cv2.imshow("Graficas valores", img)
            
        except json.JSONDecodeError:
            print('Error de json, dato incompleto:', dato)
        except Exception as e:
            print('Error', e)
            continue
            
    elif not transmitiendo:
        cv2.imshow("Graficas valores", fondo)

puerto.close()
cv2.destroyAllWindows()