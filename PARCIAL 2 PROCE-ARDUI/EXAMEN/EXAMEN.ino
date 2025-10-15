/*
BLUETOOHT IZQ RECEPTORES
1. AL INICIAR RGB ROJO DE CALLE = APAGADO
2. UN BTN LO VA ENCENDER AL PRESIONARLO Y =VERDE, SI VUELVE A APRETAR ROJO Y NO SE ENVIAN DATOS

otro btn manda los datos

RANDOM 100 Y 1000


//bluetooth y valor fotocelda
*/
#include "BluetoothSerial.h"
#include<DHT.h>
//#define pin 15
BluetoothSerial conexion;


#define LEDROJO 19
#define LEDVERDE 18
#define LEDAZUL 5
#define fotocel 15

#define btn 2
#define btn2 21
bool bandera = false;
String cad = "";
void setup() {
  // put your setup code here, to run once:
 
  conexion.begin("ESPJared");
  pinMode(fotocel,INPUT); 
  pinMode(btn,INPUT);
  pinMode(btn2,INPUT);
  pinMode(LEDROJO, OUTPUT);	// todos los pines como salida
  pinMode(LEDVERDE, OUTPUT);
  pinMode(LEDAZUL, OUTPUT);
  //dht.begin();

  analogWrite(LEDROJO, 255);	
  analogWrite(LEDVERDE, 0);
  analogWrite(LEDAZUL, 0);			
   Serial.begin(115200);
}

void loop() {
  // put your main code here, to run repeatedly:
  //
  
  int estado = digitalRead(btn);
  int estado1 = digitalRead(btn2);
  //Serial.println(estado); //0 si no esta siendo presionado
  delay(100);

  if(estado == 1  || bandera == true){
    if(estado == 1){
      bandera = !bandera;
    }
  
  

    if(bandera == true){
        
        
      analogWrite(LEDROJO, 0);	
      analogWrite(LEDVERDE, 255);
      analogWrite(LEDAZUL, 0);	
      if(estado1 == 1){
        
        delay(3000);
        int g = random(100,1000);

        cad = String("Bluetooth") +"-"+ String(g);
        //Serial.println(cad);
        conexion.println(cad);
        delay(2000);
      }
    }else{
      analogWrite(LEDROJO, 255);	
      analogWrite(LEDVERDE, 0);
      analogWrite(LEDAZUL, 0);			
        
        
    }


  }


}
