#include <WiFi.h>
const char* ssid = "MEGACABLE-2.4G-A2AB";//nombre de red
const char* password="RneVxgWd7P";
//const char* ssid = "informatica7";//nombre de red
//const char* password="Info_@@7";
//RneVxgWd7P
//SSID:	MEGACABLE-2.4G-A2AB


WiFiServer serve(8888);
WiFiClient cliente = serve.available();


void setup() {
   Serial.begin(115200);
  // put your setup code here, to run once:
  WiFi.begin(ssid,password);
  while(WiFi.status() != WL_CONNECTED){
    delay(1000);
    Serial.println("Conectandose...");
  }


  Serial.println("Cliente Conectado");
  Serial.println(WiFi.localIP());//ESTA COMPU
  serve.begin();
}

void loop() {
  int g = random(0,255);
  if(!cliente || !cliente.connected()){
    cliente = serve.available();
  }
  cliente.println(String(g));
  delay(1000);
}