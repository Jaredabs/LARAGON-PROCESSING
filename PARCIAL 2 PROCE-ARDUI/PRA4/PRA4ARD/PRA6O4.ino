#include <WiFi.h>
//const char* ssid = "informatica7";//nombre de red
//const char* password="Info_@@7";
const char* ssid = "MEGACABLE-2.4G-A2AB";//nombre de red
//const char* password="Info_@@7";
const char* password="RneVxgWd7P";
WiFiServer serve(8888);
WiFiClient cliente = serve.available();



void setup() {
  // put your setup code here, to run once:
  Serial.begin(115200);
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
 // Serial.println(WiFi.localIP());
  int r = random(0,100);
  //int g = random(0,255);
  //int b = random(0,255);
  //String colores = String(r)+"-"+String(g)+"-"+String(b);

  if(!cliente || !cliente.connected()){
    cliente = serve.available();
  }

  ;
  //if(cliente){
    
    
      cliente.println(r);
      Serial.println(r);
      delay(1000);
    
    
    
  //}

  
  
}
