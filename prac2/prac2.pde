import processing.serial.*;
Serial puerto;
float dato = 0.0, dato1 = 0.0, dato2 = 0.0;
String valor = "";
ArrayList<Float> g1 = new ArrayList<Float>();
//ArrayList<Float> g2 = new ArrayList<Float>();
int max = 100;

void setup() {
  size(600, 300);
  puerto = new Serial(this, "COM4", 115200);
  puerto.bufferUntil('\n');
}

void draw() {
  background(255);

  // Texto para la gráfica G1 (dato mapeado 1 y 50)
  stroke(0);
  fill(100);
  textSize(18);
  text("dato mapeado 1 y 50: "+dato1, 10, 20);
stroke(0, 0
, 0);
  /* Texto para la gráfica G2 (dato mapeado 50 y 100)
  stroke(0);
  fill(100);
  textSize(18);
  text("dato mapeado 50 y 100: " + dato2, 10, 40);*/

  // Gráfica para G1
  stroke(0, 255, 0); // Color verde
  float yMin =map(100,15,100,height-10,100);
  line(0,yMin,width, yMin);
  noFill();
  beginShape();
  for (int i = 0; i < g1.size(); i++) {
    float y = g1.get(i);
    vertex(i * (width / float(max)), y);
  }
  endShape();
}
/*
  // Gráfica para G2
  stroke(255, 0, 0); // Color rojo
  noFill();
  beginShape();
  for (int i = 0; i < g2.size(); i++) {
    float y = g2.get(i);
    vertex(i * (width / float(max)), y);
  }
  endShape();
}*/

void serialEvent(Serial puerto) {
  valor = puerto.readStringUntil('\n');

  if (valor != null) {
    try {
      dato = float(valor);
      dato1 = map(dato, 1, 4095, height-10, 100);
      //dato2 = map(dato, 1, 500, height -50, 100);
      g1.add(dato1);
      //g2.add(dato2);

      if (g1.size() > max) {
        g1.remove(0);
        //g2.remove(0);
      }
    } catch (NumberFormatException e) {
      println("Error de formato de número: " + valor);
    }
  }
}
