import processing.serial.*;
Serial puerto;
String dato="";
String t="",h="",tf="";
ArrayList<Float> temperatura = new ArrayList<Float>();
ArrayList<Float> humedad = new ArrayList<Float>();
ArrayList<Float> tf2 = new ArrayList<Float>();
int tope = 30;




void setup(){
  size(1000,600);
  //print(Serial.list());
  puerto = new Serial(this, "COM5",115200);
  puerto.bufferUntil('\n');//limpiar buffer
  
}

 
void draw(){
  background(255,255,255);
  /*for (int x=0; x< tope;x = x++){
    /*fill(200);
    textSize(18);
    text("Temperatura: ",20,50);
    text(temperatura.get(x),x*35,10);
    
    fill(200);
    textSize(18);
    text("Humedad: ",40,50);
    text(humedad.get(h),x*35);
    
    fill(200);
    textSize(18);
    text("NOSE: ",60,50);
    text(tf.get(x),270,x*35);
  }*/
  
  stroke(0);
  line(410,550,780,550);
  line(410,100,410,552);
  
  if (temperatura.size() > 1){//si hay un dato grafica
   
    stroke(255,0,0);
    noFill();
    beginShape();//lineacontinua
    
    for (int i = 0; i<temperatura.size();i++){
      
      fill(200);
      textSize(18);
      text("Temperatura: ",430,225);
      text(temperatura.get(i),430,240);
      float t = temperatura.get(i);
      float y = map(t,0,50,550,100);
      float x = map(i,0,tope,430,770);
      vertex(x,y);
      
    }
    endShape();
  }
}

void serialEvent(Serial puerto){
  dato = puerto.readStringUntil('\n');
  
  if (dato != null){
    dato = trim(dato);
    println(dato);
    String []val = dato.split("-");//parte la cadena apartir de carctaer
    h = val[0];
    t = val[1];
    tf=val[2];
    
    humedad.add(float(h));
    temperatura.add(float(t));
    tf2.add(float(tf));
    
    if (humedad.size() > tope){
      humedad.remove(0);
      temperatura.remove(0);
      tf2.remove(0);
}
}
}
