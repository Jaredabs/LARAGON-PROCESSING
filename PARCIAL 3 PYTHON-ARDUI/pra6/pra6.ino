#include<ArduinoJson.h>
void setup() {
  Serial.begin(115200);


}
void loop() {
  StaticJsonDocument<200> doc;
  JsonArray labels = doc.createNestedArray("labels");//cremos etiqueta parte documento, empaquetar datos(sobre donde envias cosas o lista)
  labels.add("A");
  labels.add("B");
  labels.add("C");
  labels.add("D");

  JsonArray values = doc.createNestedArray("values");//cremos etiqueta parte documento, empaquetar datos(sobre donde envias cosas o lista)
  values.add(random(20,100));
  values.add(random(20,100));
  values.add(random(20,100));
  values.add(random(20,100));

  serializeJson(doc,Serial);
  Serial.println();
  delay(1000);
}
