/*#include "BluetoothSerial.h"
#include<DHT.h>
#define pin 2
BluetoothSerial conexion;

#define DHTTYPE DHT11

DHT dht(pin, DHTTYPE);//DHTTP ES TEMEPAR Y HUMEDAD AMBIENTE*/
String cad = "";
#define pin 34

void setup() {
  // put your setup code here, to run once:
  Serial.begin(115200);
  //conexion.begin("ESPROA");
  //dht.begin();
}

void loop() {
  //conectar sensor de humedad
  // put your main code here, to run repeatedly:
  delay(1000);
  int h = analogRead(pin);
  float valor = map(h,1,1000,1,100);
  Serial.print(valor);
  delay(500);

}
