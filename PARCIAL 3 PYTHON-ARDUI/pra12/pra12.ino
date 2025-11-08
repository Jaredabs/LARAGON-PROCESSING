#include<ArduinoJson.h>

bool band = false;
void setup() {
  // put your setup code here, to run once:
Serial.begin(115200);
}

void loop() {
  // put your main code here, to run repeatedly:
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
    serializeJson(doc,Serial);
    Serial.println();
  }
  if(Serial.available()){
    char c = Serial.read();
    if(c == '1'){
      band = !band;
    }
  }
  delay(1000);
}