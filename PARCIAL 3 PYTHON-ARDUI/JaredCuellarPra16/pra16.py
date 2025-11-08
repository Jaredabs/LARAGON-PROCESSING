# -*- coding: utf-8 -*-
"""
Created on Wed Nov  5 20:52:20 2025

@author: Absja
"""
import matplotlib.pyplot as plt
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

plt.ion()
while True:
    try:
        dato = servidor.recv(1024).decode().strip()
        dato1 = int(dato)
        if not dato:
            continue
        
        lista.append(dato1)
        if len(lista) > 5:
            lista.pop(0)
        fig, ax = plt.subplots(1,1, figsize=(10,4))
        
        
        grafico = ax.bar(range(len(lista)),lista)
        ax.set_ylim(0,450)
        #print(lista)
        for _grafico, _lista in zip(grafico, lista):
            ax.text(_grafico.get_x() + _grafico.get_width()/2,
                    _lista + 1,
                    str(_lista),
                    ha='center', va='bottom', fontsize=10, color='black') 
            
        ax.set_xlabel('Random')
        ax.set_ylabel('Valores')
        ax.set_title('Grafico de barras con OpenCV')
        fig.canvas.draw()
        img = np.array(fig.canvas.buffer_rgba())
        img = cv2.cvtColor(img,cv2.COLOR_RGB2BGR)
        cv2.imshow('Grafico', img)
        cv2.waitKey(1)
        key = cv2.waitKey(25) & 0xFF 
        if  key == ord('q'):
            break
    
    except Exception as e:
        print("Error",e)
        
servidor.close()
cv2.destroyAllWindows()