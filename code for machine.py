#!/usr/bin/env python
#code for smart machine authorizer
import spidev
import time
import os
import sys
import tty
import termios
import signal
import thread
import logging
import requests
import RPi.GPIO as GPIO
import SimpleMFRC522
import MFRC522


#initialising actuator (here, LED)
GPIO.setmode(GPIO.BCM)
GPIO.setwarnings(False) 
bulb1 = 26 #pin 37 #GND 39 #3v3 pin1,17 #5V pins 2,4
GPIO.setup(bulb1, GPIO.OUT)


#RFID CARD READER  
reader = SimpleMFRC522.SimpleMFRC522()

# Open SPI bus
spi = spidev.SpiDev()
spi.open(0,0)
spi.max_speed_hz=1000000


# Define sensor channels
light_channel = 0

# Define delay between readings
delay = 5
#-------------------------------------------------------------------------------
# Function to read SPI data from MCP3008 chip
# Channel must be an integer 0-7
def ReadChannel(channel):
  adc = spi.xfer2([1,(8+channel)<<4,0])
  data = ((adc[1]&3) << 8) + adc[2]
  return data
 
# Function to convert data to voltage level,
# rounded to specified number of decimal places.
def ConvertVolts(data,places):
  volts = (data * 3.3) / float(1023)
  volts = round(volts,places)
  return volts
#---------------------------------------------------------------------------

#---------------------------------------------------------------------------
    
def get_id():
    id, text = reader.read()
    return id

    
try:
        
        while True:
            flag=0
            print("---------------------------------")
            print("Place your CARD to be READ for entry")
            id, text = reader.read()
            print("UID to Number: "),id
            print("Name: "),text
            print("...........................: ")
            print("=============================================")
            print("Hi "),text
          
            print("=============================================")
            print("Arrival:")
            cardId=id
            URL='http://192.168.43.81/sma/APIs/machinestart_api.php' 
            rfid=cardId
            PARAMS = {'rfid':rfid}
            r = requests.get(url = URL, params = PARAMS) 
            data = r.json()
            if(data['code']=='404'):
                print("No such user found")
				GPIO.output(bulb1, GPIO.LOW)
                #bulb remains off
            else:
                print(data['code'])
				flag=1
				GPIO.output(bulb1, GPIO.HIGH)
				while flag==1:
					light_level = ReadChannel(light_channel)
					light_volts = ConvertVolts(light_level,2)
					print("Light: {} ({}V)".format(light_level,light_volts))
				
					# Wait before repeating loop
					time.sleep(delay)
					#bulb turns on
					
            

          

            print("\n\n\n\n       SIIC FabLab      ")
            print("---------------------------------")
            print("Place your CARD to be READ for exit")
            id_forexit=get_id()
            URL='http://192.168.43.81/sma/APIs/machinestop_api.php'
            rfid=id_forexit
            
            PARAMS = {'rfid':rfid}
            r = requests.get(url = URL, params = PARAMS) 
            data = r.json()
            if(data['stu_id']=='0'):
                print("No such user found")
				GPIO.output(bulb1, GPIO.HIGH)
                #bulb remains switched on
            else:
                print(data['name'])
				GPIO.output(bulb1, GPIO.LOW)
                #bulb switches off
    
#else:
    #print("Some error please try again")
    #print("++++++++++++++++++++++++++++++++++++++++++++++")
    #mainfunc()

finally:
        GPIO.cleanup()
