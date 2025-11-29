# -*- coding: utf-8 -*-
"""
Created on Fri Nov  7 12:56:28 2025

@author: Absja
"""

import cv2
import socket
import numpy as np
import json


host = "0.0.0.0"
puerto = 4999
servidor = socket.socket(socket.AF_INET,socket.SOCK_STREAM)
servidor.bind((host,puerto))
servidor.listen(1)#Escuchando peticion

con, addr = servidor.accept()
print(f"Se conecto {addr}")
lista = []

while True:
    try: 
        dato = con.recv(1024).decode().strip()
        if not dato:
            continue
        print(dato)
        lista.append(dato)
        if len(lista) >5:
            break
        
    except Exception as e:
        print(f"Error {e}")
        break
con.close()
servidor.close()