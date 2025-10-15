#include "BluetoothSerial.h"
#include<DHT.h>
#define pin 15
BluetoothSerial conexion;

#define DHTTYPE DHT11

DHT dht(pin, DHTTYPE);//DHTTP ES TEMEPAR Y HUMEDAD AMBIENTE
String cad = "";


void setup() {
  // put your setup code here, to run once:
  Serial.begin(115200);
  conexion.begin("ESPJared");
  dht.begin();
}

void loop() {
  //conectar sensor de humedad
  // put your main code here, to run repeatedly:
  delay(3000);
  float h = dht.readHumidity();
  float t = dht.readTemperature();
  float tf = dht.readTemperature(true);

  Serial.print("Humedad: ");
  Serial.print(h);
  Serial.println("%");
  Serial.print("Temperatura en C: ");
  Serial.print(t);
  Serial.println("C '");
  Serial.print("Temperatura en F: ");
  Serial.print(tf);
  Serial.println("F '");

  cad = String(h) +"-"+String(t)+"-"+String(tf);
  conexion.println(cad);
  delay(500);
}
