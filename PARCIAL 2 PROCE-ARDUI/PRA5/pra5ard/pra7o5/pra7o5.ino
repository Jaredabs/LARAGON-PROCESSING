#include <WiFi.h>
const char* ssid = "TecJalisco";//nombre de red
//const char* password="Info_@@7";
const char* password="";
WiFiServer serve(8888);
WiFiClient cliente = serve.available();

#define btn 2
#define bu 4
bool bandera = false;
void setup() {
  
  pinMode(btn,INPUT);
  pinMode(bu,OUTPUT);
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
  // put your main code here, to run repeatedly:

 /* if (!cliente || !cliente.connected()) {
    cliente = serve.available();
    if (cliente) {
      Serial.println("¡Processing se ha conectado!");
    }
  }
*/
  Serial.println(WiFi.localIP());
  int estado = digitalRead(btn);
  Serial.println(estado); //0 si no esta siendo presionado
  delay(100);
  
  if(estado == 1 || bandera == true){
    Serial.println("Boton Presionado");
    if(estado == 1){
      
      Serial.println("Cambio de Bandera: ");
      bandera = !bandera;
      Serial.println("Bandera: ");
      Serial.print(bandera);
      delay(500);
    }
    

    if(bandera == true){
      tone(bu,2000);
      Serial.println("sonido");
      delay(1000);
      noTone(bu);
      int g = random(0,255);
       if(!cliente || !cliente.connected()){
        cliente = serve.available();
      }
      cliente.println(g);
    }else{
      
      noTone(bu);
      Serial.println("Apagado");
    }
    

}
}
