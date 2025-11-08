import cv2
import matplotlib.pyplot as plt
import numpy as np
import serial
import json

lista = []
puerto = serial.Serial("COM4",115200)

plt.ion()#gráfico se actualice sin necesidad de 
#cerrar y volver a abrir la figura en cada ciclo.

while True:
    try:
        linea = puerto.readline().decode().strip()#eliminar espacios el strip
        if not linea:
            continue
        objeto = json.loads(linea)#Convierte la cadena JSON (linea) en un diccionario de Python.
        print(objeto)
        valor = objeto["values"]#Extrae la lista de valores (ej. [57, 50, 85]) del diccionario JSON bajo la clave "values".
        lista.append(valor)
      
        if len(lista) > 5:
            list.pop(0)#dato mas antiguo o fila
        
        fig, ax = plt.subplots()#Crea una nueva figura (fig) y un eje (ax)
        #grafico = ax.plot(lista)
        #ax.set_ylim(0,400)
        grafico = ax.bar(range(len(lista)),lista)        
        ax.set_ylim(0,400)#limite de grafico en altura
        
        for _grafico, _lista in zip(grafico,lista):
            ax.text(_grafico.get_x() + _grafico.get_width()/2,
                    _lista + 1,
                    str(_lista),
                    ha = 'center', va='bottom', fontsize=10, color='black')
      
        ax.set_xlabel('Sensor')#etiqueta del Eje X.
        ax.set_ylabel('Valores')
        ax.set_title('Grafico de barras')

        fig.canvas.draw()#edibujar la figura con los nuevos datos.
        img = np.array(fig.canvas.buffer_rgba())#Captura el gráfico renderizado por Matplotlib
        #y lo convierte en una matriz de NumPy (array), listo para ser usado por OpenCV.
        img = cv2.cvtColor(img, cv2.COLOR_RGB2BGR)
        cv2.imshow('Grafico con OPENCV', img)
        cv2.waitKey(1)#Espera 1 milisegundo por un evento de teclado. Esto es crucial en OpenCV para que la ventana se actualice y para que el bucle while no se bloquee.
        plt.close(fig)
        
        if cv2.waitKey(25) & 0xFF == ord('q'):#espacio de memoria es 0xff
           
           break
    except json.JSONDecodeError:
        print('Error de json')
    except Exception as e:
        print('Error,',e)
        break
puerto.close()
cv2.destroyAllWindows()