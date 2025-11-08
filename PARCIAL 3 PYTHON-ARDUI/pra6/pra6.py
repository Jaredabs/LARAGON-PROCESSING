import cv2
import matplotlib.pyplot as plt
import numpy as np
import serial
import json


puerto = serial.Serial("COM4",115200)

plt.ion()
ejerx=['A','B','C','D']
ejesy =[]
while True:
    try:
        linea = puerto.readline().decode().strip()#eliminar espacios el strip
        if not linea:
            continue
        objeto = json.loads(linea)
        print(objeto)
        
        ejesx = objeto["labels"]
        ejesy = objeto["values"]
        
        fig, ax = plt.subplots()
        grafico = ax.bar(ejerx,ejesy, color='skyblue')


        for grafico, ejesy in zip(grafico,ejesy):
            ax.text(grafico.get_x() + grafico.get_width()/2,
                    ejesy + 1,
                    str(ejesy),
                    ha = 'center', va='bottom', fontsize=10, color='black')
        ax.set_xlabel('Ejes X')
        ax.set_ylabel('Ejes y')
        ax.set_title('Grafico de barras')

        fig.canvas.draw()
        img = np.array(fig.canvas.buffer_rgba())
        img = cv2.cvtColor(img, cv2.COLOR_RGB2BGR)
        cv2.imshow('Grafico con OPENCV', img)
        cv2.waitKey(0)
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