# -*- coding: utf-8 -*-
"""
Created on Tue Oct 28 13:33:35 2025

@author: Absja
"""

import cv2
import matplotlib.pyplot as plt
from matplotlib import cm
import numpy as np
import serial
import json


lista = []
puerto = serial.Serial("COM4",115200)

plt.ion()

while True:
    try:
        linea = puerto.readline().decode().strip()
        if not linea:
            continue
        objeto = json.loads(linea)
        print(objeto)
        valor = objeto["values"]
        lista.append(valor)
        if len(lista) > 5:
            lista.pop(0)
        fig, graf = plt.subplots(2,2, figsize=(10,4))
        ax = graf[0,0]
        bx = graf[0,1]
        cx = graf[1,0]
        dx = graf[1,1]
        
        #grafico 1
        grafico = ax.bar(range(len(lista)),lista)
        ax.set_ylim(0,450)
        print(lista)
        for _grafico, _lista in zip(grafico, lista):
            ax.text(_grafico.get_x() + _grafico.get_width()/2,
                    _lista + 1,
                    str(_lista),
                    ha='center', va='bottom', fontsize=10, color='black') 
            
        ax.set_xlabel('Sensor')
        ax.set_ylabel('Valores')
        ax.set_title('Grafico de barras con OpenCV')
        
        
        #grafico 2
        valornuevo = 450 - valor 
        bx.pie([valor,valornuevo], labels=["Potenciometro","Restante"], 
               autopct="%1.1f%%")
        bx.set_title('Grafico CIRCULAR con OpenCV')
        
        
        #GRAFICO 4
        fig.delaxes(dx) 
        dx = fig.add_subplot(2, 2, 4, projection='3d')
        
        xpos = np.arange(len(lista)) 
        ypos = 0
        zpos = 0                       
        
        dz = np.array(lista)
        
       
        dx.bar3d(xpos, ypos, zpos, 0.8, 0.8, dz, color='cyan') 
        
        # 4. Configuración
        dx.set_title('Gráfico 4: Barras 3D Dinámicas')
        dx.set_xlabel('Muestra')
        dx.set_ylabel('Constante')
        dx.set_zlabel('Valor')
        dx.set_xlim(0, 5) 
        dx.set_ylim(0, 1) 
        dx.set_zlim(0, 450)
        
        #GRAFICO 3
        
        for _grafico, _lista in zip(grafico, lista):
            ax.text(_grafico.get_x() + _grafico.get_width()/2,
                    _lista + 1,
                    str(_lista),
                    ha='center', va='bottom', fontsize=10, color='black') 
        cx.plot(range(len(lista)),lista)
        fig.canvas.draw()
        img = np.array(fig.canvas.buffer_rgba())
        img = cv2.cvtColor(img,cv2.COLOR_RGB2BGR)
        cv2.imshow('Grafico', img)
        cv2.waitKey(1)
        if cv2.waitKey(25) & 0xFF == ord('q'):
            break
    except json.JSONDecodeError:
        print('Error de json')
        
    except Exception as e:
        print('Error', e)
        break

puerto.close()   
cv2.destroyAllWindows()