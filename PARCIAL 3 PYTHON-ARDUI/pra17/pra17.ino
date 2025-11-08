#include <WiFi.h>
#include<ArduinoJson.h>
//const char* ssid = "MEGACABLE-2.4G-A2AB";//nombre de red
//const char* password="RneVxgWd7P";
const char* ip= "192.168.16.163";
const int puerto = 4999;
const char* ssid = "informatica7";//nombre de red
const char* password="Info_@@7";
//RneVxgWd7P
//SSID:	MEGACABLE-2.4G-A2AB


//WiFiServer serve(8888);
WiFiClient cliente;


void setup() {
   Serial.begin(115200);
  // put your setup code here, to run once:
  WiFi.begin(ssid,password);
  while(WiFi.status() != WL_CONNECTED){
    delay(1000);
    
  }

  if(cliente.connect(ip, puerto)){
    Serial.println("Si se conecto al servidor");
  }else{
    Serial.println("No se conecto");
  }

  /*Serial.println("Cliente Conectado");
  Serial.println(WiFi.localIP());//ESTA COMPU
  serve.begin();*///Esto es cuando esp era servidor
}

void loop() {
  StaticJsonDocument<100> doc;
  int g = random(0,255);
  JsonArray labels = doc.createNestedArray("labels");
  labels.add("valor");

  JsonArray values = doc.createNestedArray("values");
  values.add(g);
  String datos;
  serializeJson(doc,datos);

  if(cliente.connected()){
    cliente.println(datos);
  }else{
    if(cliente.connect(ip, puerto)){
      Serial.println("El cliente se reconecto....");
    }
  }

  delay(1000);
}