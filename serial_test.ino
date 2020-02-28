/*void setup()
{
  Serial.begin(9600); //Start Serial Monitor to display current read value on Serial monitor
  
}

  int ADC_Value, Factor;
  unsigned long temp;
void loop() {
  /* //if (Serial.available())
  //{
    float x=0.0;
    float AcsValue=0.0,Samples=0.0,AvgAcs=0.0,AcsValueF=0.0;
  
    while(1)
    { //Get 150 samples
        AcsValue = digitalRead(A1);     //Read current sensor values   
        Samples = Samples + AcsValue;  //Add samples together
        delay (300); // let ADC settle before next sample 3ms
        x++;
        Serial.println(AcsValue);
        //if (Serial.available())
        //  break;
    }
    AvgAcs=Samples/x;//Taking Average of Samples
  
    //((AvgAcs * (5.0 / 1024.0)) is converitng the read voltage in 0-5 volts
    //2.5 is offset(I assumed that arduino is working on 5v so the viout at no current comes
    //out to be 2.5 which is out offset. If your arduino is working on different voltage than 
    //you must change the offset according to the input voltage)
    //0.100v(100mV) is rise in output voltage when 1A current flows at input
    AcsValueF = (2.5 - (AvgAcs * (5.0 / 1024.0)) )/0.100;
  
    Serial.println(AcsValueF);//Print the read current on Serial monitor
    delay(50);
    AcsValue=0.0;Samples=0.0;AvgAcs=0.0;AcsValueF=0.0;x=0; //Initialising all variables back to 0
  //}

  
    // Read multiple samples for better accuracy
    ADC_Value = analogRead(A0);
    Serial.println(ADC_Value);
    Serial.println("*****");
    ADC_Value = ADC_Value + analogRead(A0);
    ADC_Value = ADC_Value + analogRead(A0);
    ADC_Value = ADC_Value/3;
    temp = (ADC_Value-505)*Factor ;
    ADC_Value = temp/10;
    Serial.println(ADC_Value);
    delay(1000);
    
}*/

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
unsigned int total; // holds <= 64 analogReads
byte numReadings = 64;
float offset = 511.5; // calibrate zero current
float span = 0.07315; // calibrate max current | ~0.07315 is for 30A sensor
float current; // holds final current

void setup() {
  Serial.begin(9600);
}
int x =0,y;
char rcv1[10],rcv2[10],i=0;

void loop() {
  if (Serial.available()>0)
  {
      total = 0;
            y = analogRead(A0);
            
            delay(250);
            current = (-y + offset) * span;
            Serial.println(current);
           }
            
      
    
      //Serial.print("Current is  ");
      //Serial.println(current);
      //Serial.print(current, 1); // one decimal place
      //Serial.println("  Amp");
      //delay(500); // human readable
      total=0;x=0;
  }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/*
 int total; // holds <= 64 analogReads
int x = 0;
float offset = 511.5; // calibrate zero current
float span = 0.07315; // calibrate max current | ~0.07315 is for 30A sensor
float current; // holds final current

void setup() {
  Serial.begin(9600);
}

void loop() {
  total = 0; // reset
  while(1)
  {
  total += analogRead(A0);
  x++;
  if (x == 20000)
  break;
  }
  x=20;
  current = (total / x - offset) * span;

  Serial.print("Current is  ");
  Serial.print(current*-1);
  //Serial.print(current, 1); // one decimal place
  Serial.println("  Amp");
  delay(500); // human readable
}*/
