#include<WiFi.h>
#include<HTTPClient.h>

//const char* ssid = "MEGACABLE-2.4G-A2AB";
//const char*  password="RneVxgWd7P";
const char* ssid = "informatica7";
const char*  password="Info_@@7";
//WiFiServer serve(12345);

//WiFiClient cliente;

void setup() {
 Serial.begin(115200);
  WiFi.begin(ssid,password);
  while(WiFi.status() != WL_CONNECTED){
    delay(1000);
    Serial.println("Conectandose....");
  }
  Serial.println(WiFi.localIP());
  Serial.println(WiFi.status());
}
void loop() {
  if(WiFi.status() == WL_CONNECTED){
     HTTPClient cliente;//se encargara de llevar el mensaje
     // 192.168.100.10
    //cliente.begin("http://192.168.16.163:8000/api/sensores");//la ip de tu computadora a donde ir
    cliente.begin("http://192.168.16.163:8000/api/sensores");//la ip de tu computadora a donde ir
    cliente.addHeader("Content-Type","application/json");//"Oye, lo que te voy a enviar está en formato JSON", 
    //para que el servidor sepa cómo leerlo.
    int valor = random(0,70);
    String json = "{\"valor\":" + String(valor) + "}";
    int respuesta = cliente.POST(json);//Envía el mensaje al servidor. Guarda el resultado en respuesta.
    if(respuesta>0){//Verifica si el servidor contestó algo válido.
      Serial.println(cliente.getString());//Lee lo que el servidor respondió
    }else{
      Serial.print("Error: ");
      Serial.println(respuesta);
    }
    cliente.end();
  }
  delay(1000);
}