#include <SPI.h>
#include <Ethernet.h>
#include <string.h>


//Endereço MAC
byte mac[] = { 0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED };

//Como não usarei um DNS irei usar um IP numérico
IPAddress server(10,1,25,117);  // Meu IP (SEM DNS)
// char server[] = "www.google.com";    //CASO EU QUISESSE USAR DNS

// Um IP estático caso o DHCP falhar
IPAddress ip(192,168,1,68);

// Inicializa a biblioteca Ethernet Client
// com o IP e a porta do servidor que eu quiser com a porta 80 (porta por defeito do HTTP)
EthernetClient client;

int agua, count;
char c;
int sensor_temp = A0; //Lê a voltagem recebida pelo sensor de temperatura
int sensor_hum = A1; //Lê a voltagem recebida pelo sensor de humidade



//Funções:
int Temperatura(int voltagem) {
  
    float temperatura = voltagem * 5.0;
    temperatura /= 1024.0;
    temperatura = 5-temperatura;
    temperatura = ((temperatura*125)/5)-25;
    return temperatura;
}

int Humidade(int voltagem) {
   //Valor do sensor para 1023
   voltagem = constrain(voltagem, 485, 1023);
   //Valor de 1023 para %
   int hum = map(voltagem, 485, 1023, 100, 0);
   return hum;
}





void setup()
{
	// Apre ligação com o Serial
	Serial.begin(9600);

	// Inicia a conexão Ethernet 
	if (Ethernet.begin(mac) == 0)
	{
		Serial.println("Erro ao tentar configurar a Ethernet usando o DHCP");

		// Tenta configurar usando o IP adress em vez de usar o DHCP
		Ethernet.begin(mac, ip);
	}
	// Um segundo para o Ethernet Shield ligar
	delay(1000);

	Serial.println("---------------------------Estufa Automatizada----------------------------");
	Serial.println("-------------------------------Bruno Coelho-------------------------------");
	Serial.println("connecting...");

	pinMode(3, OUTPUT);
	pinMode(4, OUTPUT);

	
	count = 30; //Mandará a temperatura e tudo o resto logo que iniciar 
}

void loop()
{
	if (client.connect("192.168.1.64", 80))
	{
		if (count == 30)
		{
			
                        //voltagem recebida pelo sensor
                        int v_sensor_temp = analogRead(sensor_temp);
                        //Conversão de voltagem para temperatura
                        int temp = Temperatura(v_sensor_temp);
                        
                        //voltagem recebida pelo sensor
                        int v_sensor_hum = analogRead(sensor_hum);
                        //Conversão de voltagem para humidade
                        int hum = Humidade(v_sensor_hum);
                        
                        
			// Fará REQUEST HTTP
			client.print("GET /PSI/pap/v1.6/arduino_php/inserir.php?");
			client.print("temp=");
			client.print(temp);
			client.print("&hum=");
			client.print(hum);
			client.println( " HTTP/1.1");
			client.println("Host: 192.168.1.64");
			client.println("Connection: close");
			client.println();
			
			Serial.print("Temperatura enviada para a bd: ");
			Serial.println(temp);
			Serial.print("Estado da Agua: ");
			Serial.println(agua);
			Serial.println();
		        
                        agua = 0; //Volta a ter valor 0 para diferenciar de desligado automaticamente/manualmente com já desligado
			count = 0; //Depois de ter mandado todos os valores os segundos voltarão para 0
		}
		
                //Fará um request para ler o seu conteúdo
		client.println("GET /PSI/pap/v1.6/arduino_php/fazer.php HTTP/1.0");
                client.println();
        
		Serial.print("Debug: ");

        //Lerá tudo o que está na página 
        while (client.connected() && !client.available()) delay(10); //Espera pela resposta do servidor
		while (client.connected() || client.available())
		{
			c = client.read();
/*
O HTTP Response header está formatado para apresentar as informações relativas ao header separadas por uma linha. 
O que separa o header do corpo da resposta são 4 caracteres que representam 2 quebras de linha seguidas "\r\n\r\n".
Com isto lemos a resposta até chegar à separação mas só temos em conta o corpo em si da resposta - 's' ou 'n'
*/
			if (c == '\r')
			{
				c = client.read();
				if (c == '\n')
				{
					c = client.read();
					if (c == '\r')
					{
						c = client.read();
						if (c == '\n')
						{
							c = client.read();
							Serial.print(c);
							Serial.println();

							if (c == 's')
							{
                                                        
  						          digitalWrite(3, LOW);
                                                          digitalWrite(4, HIGH);
                    
                                                          agua = 2;
  							  Serial.println("A agua esta ligada.");
                                                        
							}
							if (c == 'n')
							{
                                                              if(agua == 0)
                                                              {
                                                                digitalWrite(3, HIGH);
                                                                digitalWrite(4, LOW);
                                                                
                                                                //A água ainda está desligada, logo não é necessário de mandar para a bd
								agua = 0;
                                                                Serial.println("A agua esta desligada.");
                                                              }
                                                              else
                                                              {
                                                                 digitalWrite(3, HIGH);
                                                                 digitalWrite(4, LOW);
                                                                 
                                                                //A água foi desligada automaticamente/manualmente
								agua = 1;
                                                                Serial.println("A agua esta desligada.");
                                                              }
                                                              
  								
								
							}
						}
					}
				}
			}
		}


                Serial.println("A procurar dados diferentes.");
		Serial.println();
		client.stop();
	}
	else
		Serial.println("Erro ao ligar-se ao servidor web");
		
	count++;
	delay (1 * 1000);
}
