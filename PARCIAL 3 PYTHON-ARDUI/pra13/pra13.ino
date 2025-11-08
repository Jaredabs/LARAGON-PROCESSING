#include "BluetoothSerial.h"
#include<ArduinoJson.h>


#if !defined(CONFIG_BT_ENABLED) || !defined(CONFIG_BLUEDROID_ENABLED)
#error Bluetooth no esta habilitado
#endif
bool band = false;
BluetoothSerial puerto;


void setup() {
  puerto.begin("ESP_INFOJared");
  Serial.begin(115200);  

}

void loop() {
  StaticJsonDocument<100> doc;
  if(band){
    int val1 = random(1,100);
    int val2 = random(1,100);
    JsonArray labels = doc.createNestedArray("labels");
    labels.add("val1");
    labels.add("val2");
    JsonArray values = doc.createNestedArray("values");
    values.add(val1);
    values.add(val2);
    serializeJson(doc,puerto);
    puerto.println();
  }
  if(puerto.available()){
    char c = puerto.read();
    if(c == '1'){
      band = !band;
    }
  }
  delay(1000);

}
