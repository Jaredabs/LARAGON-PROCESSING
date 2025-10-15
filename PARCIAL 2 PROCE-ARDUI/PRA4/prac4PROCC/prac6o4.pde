//192.168.16.116
//import java.net.*;
//import java.io.*;
import processing.net.*;

//Socket socket;
Client cliente;
BufferedReader leer;
String dato = "";
int r =255;
int g = 255;
int b = 255;
ArrayList<Float> gra = new ArrayList<Float>();

void setup(){
  size(600,800);
  try{
    cliente = new Client(this,"192.168.16.117",8888);
    //leer = new BufferedReader(new InputStreamReader(socket.getInputStream()));Línea comentada que muestra cómo se habría inicializado el BufferedReader si se hubiera usado un objeto Socket (línea 6).
    println("Conectado a la ESP32");
  
  
  }catch(Exception e){
    println("Error en la conexion");
    
  }
  
}

void draw(){
  background(255);
  textSize(12);
  fill(0,255,0);//Comprueba si hay datos disponibles para leer en el buffer de la conexión del cliente. Si es mayor que cero, hay datos nuevos.
  int ancho = 50;
  int espacio = 50;
  int base = 300;
  int x = 0;
  
  
  
  text("Grafica Wifi",15,35);
  if(cliente.available()>0){
    String mens = cliente.readStringUntil('\n'); //Lee la cadena de datos entrantes desde el servidor hasta que encuentra un carácter de nueva línea (\n). Almacena el resultado en la variable local mens.
     if(mens != null){//Comprueba si la lectura anterior fue exitosa y no devolvió un valor null (que podría ocurrir si la conexión se cierra inesperadamente).
        dato = mens.trim();//Elimina los espacios en blanco iniciales y finales (incluidos los caracteres de nueva línea y retorno de carro) de la cadena leída y la asigna a la variable global dato.
        gra.add(float(dato));
        
        if(gra.size() > 12){
          gra.remove(0);
        }
        
        
        /*String []d = dato.split("-");
        println(d[0]);
        println(d[1]);
        println(d[2]);
        
        r = int(d[0]);
        g = int(d[1]);
        b = int(d[2]);*/
        //dato = "";
     }
     }
       
        for (int i = 0; i < gra.size(); i++) {
          float y = gra.get(i);
          stroke(255);
          fill(0,255,0);
         
          rect(x, base - y,ancho, y);
          fill(0);
           textSize(18);
           textAlign(CENTER);
          text(nf(y, 0, 2), x +ancho/2, base - y - 10);
         // vertex(i * (width / float(20)), y);

         
         
         x += espacio;
        }
     
}
