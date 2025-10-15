//192.168.16.116

//192.168.100.10

import processing.net.*;

String valor = "0";
//Socket socket;
Client cliente;
String dato = "";
ArrayList<Float> gra = new ArrayList<Float>();
void setup(){
  size(600,800);
  try{
    cliente = new Client(this,"192.168.100.28",8888);
    //leer = new BufferedReader(new InputStreamReader(socket.getInputStream()));Línea comentada que muestra cómo se habría inicializado el BufferedReader si se hubiera usado un objeto Socket (línea 6).
    println("Conectado a la ESP32");
  
  
  }catch(Exception e){
    println("Error en la conexion");
    
  }
  
}

void draw() {
  
  // Esta parte solo se ejecuta cuando llega un nuevo dato desde el ESP32.
  if (cliente.available() > 0) {
    String mens = cliente.readStringUntil('\n');//LEE MENSAJE HASTA ESPACIO
    if (mens != null) {//SI HAY DATOS ENTONCES
      dato = mens.trim();//ELIMINA BLANCOS FINAL INICIO
      valor = dato;
      gra.add(float(dato)); // Agrega el nuevo valor a la lista
    }
  }

  // --- 2. LÓGICA PARA DIBUJAR (se ejecuta siempre, en cada frame) ---
  background(255); // Limpia la pantalla para evitar "manchas"



  // Dibuja el valor numérico principal
  //NUMERO NADA QUE VER CON GRAFICA SOLO EN TXT
  textSize(40);
  fill(0, 0, 0);//RELLENO DEL TEXTO
  textAlign(CENTER, CENTER);
  text(valor, width / 2, height / 2);



  // Dibuja los ejes de la gráfica
  int base = 300;
  strokeWeight(1);
  stroke(0, 0, 255); //COLOR LINEAS
  
  line(45, base, width - 20, base); // Eje X HORIZONTAL
  line(45, 30, 45, base);           // Eje Y VERTICAL
  //line(x1, y1, x2, y2);
  //(x1, y1): Coordenadas del punto de inicio.
//(x2, y2): Coordenadas del punto final.

  // Dibuja TODOS los puntos que están en la lista 'gra'
  int ancho = 50;
  int espacio = 50;
  int x = 70; // Reinicia la posición X en cada frame para dibujar desde el principio

  strokeWeight(10); // Grosor para los puntos


  // Este bucle AHORA ESTÁ FUERA del 'if', por eso siempre se ejecuta
  for (int i = 0; i < gra.size(); i++) {
    float altura = gra.get(i);//LOS PUNTOS AGARRAN ESTE VALOR
    
    // Cambia de color si el valor es alto
    /*if (altura > 100) {
      stroke(255, 0, 0); // Rojo
    } else {
      stroke(0, 0, 0);   // Negro
    }*/
    
    float y = base - altura; // Calcula la posición Y (valores más altos van más arriba)
    point(x, y); // Dibuja el punto

    // Dibuja el valor numérico encima de cada punto
    textSize(14);
    fill(100); // Color del texto
    textAlign(CENTER);
    text(int(altura), x, y - 15); // Muestra el valor un poco arriba del punto
    
    x += ancho + espacio; // Avanza la posición X para el siguiente punto
    if (gra.size() > 5){
      gra.remove(0); //Si la lista tiene más de 5 valores, elimina el primer elemento ([0]), asegurando que el gráfico solo muestre los últimos 5 puntos de datos (creando un gráfico deslizante).
}
  }
}

/*void serialEvent(Client cliente){
  dato = cliente.readStringUntil('\n');
  
  if (dato != null){
    dato = trim(dato);
    println(dato);
    float valor = map(float(dato),1,1000,1,100);
    
    gra.add(valor*10);//float(dato): Convierte la cadena de texto (dato) en un número de punto flotante. map(): Función que escala el valor. Si el dato original está entre 1 y 1000, lo transforma a un rango entre 1 y 100.
    if (gra.size() > 5){
      gra.remove(0); //Si la lista tiene más de 5 valores, elimina el primer elemento ([0]), asegurando que el gráfico solo muestre los últimos 5 puntos de datos (creando un gráfico deslizante).
}
}
}*/
