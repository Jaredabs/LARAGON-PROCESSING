#include<ArduinoJson.h>
void setup() {
  Serial.begin(115200);


}
void loop() {
  StaticJsonDocument<100> doc;
  
  doc["Labels"] = "Sensor";
  doc["values"] = random(10,200);

  serializeJson(doc,Serial);
  Serial.println();
  delay(1000);
}
