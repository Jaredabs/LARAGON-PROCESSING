import processing.serial.*;
Serial puerto;
String dato = "";
ArrayList<Float> datos = new ArrayList<Float>();

void setup(){
  size(600,800);
  puerto = new Serial(this, "COM4",115200);
  
}


void draw(){
  background(255);
  //lineas de referenci
  
  int ancho =50;
  int espacio = 50;
  int base = 300;
  int x = 70;
  
  //strokeWeight(1);
  stroke(255,0,0);
  line(45, base, width - 20, base);
  line(45,30,45,base);
  //texto
  
  
  //strokeWeight(10);//Gráficos. Establece el grosor de los trazos a 10 píxeles para que los puntos sean visibles.
  for (int i=0; i<datos.size();i++){
    float altura = datos.get(i);//Recupera el valor (float) de la posición actual de la lista.
    if (altura > 100){
      stroke(255,0,0);
      fill(255,0,0);
    }else{
      stroke(0);
      fill(0);
    }
    stroke(0);
    rect(x,base - altura, ancho, altura);
    float y = 300 - altura * 3;//Calcula la coordenada Y para el punto. El altura (valor recibido) se multiplica por 3 para hacerlo más visible, y se resta de 300 (la línea base) para que los valores mayores se dibujen más arriba.
    //point(x, y);
    textSize(14);
     fill(200);
    text(altura, x + ancho/2, base - altura - 10);//Dibuja el valor numérico (altura) encima del punto.
    
    x += ancho + espacio;//Mueve la coordenada x para que el siguiente punto se dibuje más a la derecha, manteniendo una separación constante.
  }
}
void serialEvent(Serial puerto){
  dato = puerto.readStringUntil('\n');
  
  if (dato != null){
    dato = trim(dato);
    println(dato);
    float valor = map(float(dato),1,1000,1,100);
    
    datos.add(valor*10);//float(dato): Convierte la cadena de texto (dato) en un número de punto flotante. map(): Función que escala el valor. Si el dato original está entre 1 y 1000, lo transforma a un rango entre 1 y 100.
    if (datos.size() > 5){
      datos.remove(0); //Si la lista tiene más de 5 valores, elimina el primer elemento ([0]), asegurando que el gráfico solo muestre los últimos 5 puntos de datos (creando un gráfico deslizante).
}
}
}

  
  
