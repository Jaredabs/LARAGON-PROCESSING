int valor1 = 50;
int valor2 = 100;
int valor3 = 150;
int valor4 = 200;

void setup(){
  size(600,400);
  
  
}



void draw(){
  background(255);
  //lineas de referencia
  stroke(255,0,0);
  line(45, 300, width - 20, 300);
  line(45,30,45,300);
  //texto
  
  textSize(20);
  fill(0);
  
  text(valor1, 50, 250 - 10);
  stroke(0);
  rect(50,250, 50, valor1);
  fill(200);
  
  text(valor2, 120, 200 - 10);
  stroke(200);
  rect(120,200, 50, valor2);
  fill(200);
  
  text(valor3, 190, 150 - 10);
  stroke(200);
  rect(190,150, 50, valor3);
  fill(200);
  
  text(valor4, 260, 100 - 10);
  stroke(200);
  rect(260,100, 50, valor4);
  fill(200);
  
  
  
  
}
