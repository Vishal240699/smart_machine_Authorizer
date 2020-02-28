import Tkinter as tk
from Tkinter import *
from tkMessageBox import *

#!/usr/bin/env python
import sys
import tty
import termios
import time
import signal
import thread
import logging

import requests

import RPi.GPIO as GPIO
import SimpleMFRC522
import MFRC522
import json

#initialising actuator (here, LED)
GPIO.setmode(GPIO.BCM)
GPIO.setwarnings(False) 

solenoidlock = 17
GPIO.setup(solenoidlock, GPIO.OUT)

#RFID CARD READER  
reader = SimpleMFRC522.SimpleMFRC522()


#-------------------------------------------------------------------------------
#------------------------------------------------------
def mainfunc():
    GPIO.output(solenoidlock, GPIO.HIGH)
    print("\n\n\n\n       SIIC FabLab      ")
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
    print(cardId)
    URL='http://192.168.43.81/sma/APIs/toolentry_api.php'
    rfid=cardId
    PARAMS = {'rfid':rfid}
    r = requests.get(url = URL, params = PARAMS) 
    data = r.json()
    if(data['stu_id']=='0'):
        print("No such user found")
        GPIO.output(solenoidlock, GPIO.HIGH) #lock is closed
        #doorlock remains locked
    else:
        print(data['name'])
        GPIO.output(solenoidlock, GPIO.LOW) #unlocked
        show_GUI(data['name'],data['stu_id'])
        GPIO.output(solenoidlock, GPIO.HIGH)
        #doorlock opens
            

    print("\n\n\n\n       SIIC FabLab      ")
    print("---------------------------------")
    print("Place your CARD to be READ for exit")
    id_forexit=get_id()
    URL='http://192.168.43.81/sma/APIs/toolentry_api.php'
    rfid=id_forexit
    PARAMS = {'rfid':rfid}
    r = requests.get(url = URL, params = PARAMS) 
    data = r.json()
    if(data['stu_id']=='0'):
        print("No such user found")
        GPIO.output(solenoidlock, GPIO.HIGH)
        #doorlock remains locked
    else:
        print(data['name'])
        GPIO.output(solenoidlock, GPIO.LOW)
        #doorlock opens
        time.sleep(5)
        GPIO.output(solenoidlock, GPIO.HIGH)    
#---------------------------------------------------------------------------
    
def get_id():
    id, text = reader.read()
    return id
#------------------------------------------------------------------------------
def show_GUI(result,student_id):


    def issue_page():
        global window1
        window1=tk.Toplevel(master)
        window1.minsize(1000,500)
        window1.geometry("220x80")
        
        global listbox1
        listbox1=Listbox(window1)
        listbox1.pack(padx=35, pady=40)
        listbox1.place(x=450, y=100)

        global text1
        text1=Text(window1)
        text1.config(state="normal")
        text1.place(x=100,y=100)
        text1.pack()
        
        #ok_btn=tk.Button(window1, fg="black", bg="white", text="OK", command=get_tool_names_i)
        #ok_btn.place(x=200, y=400)
        
        save_btn=tk.Button(window1, fg="black", bg="white", text="SAVE", command=get_tool_names_i)
        save_btn.place(x=400, y=400)
               
    
    def get_tool_names_i():
        print("ISSUE")
        file_tooli=open(r"toolcodeissue.txt","r+")
        to_write =text1.get("1.0",END)
        file_tooli.write(to_write)
        text=list(to_write.split("\n"))
        chunk=9
        for x in range(len(text)-1):
            bar=text[x]
            print(bar)
            if(len(bar)<chunk):
                break
            # get tool name from database
            URL='http://192.168.43.81/sma/APIs/toolname_api.php'
            print(URL)
            PARAMS = {'barcode':bar}
            r = requests.get(url = URL,params=PARAMS)
            #print(r.content)
            data = r.json()
            #print(data)
            if(data['Tool_name']=="null"):
                #listbox2.insert(END, "Invalid barcode")
                print("Invalid barcode")
            else:
                #listbox2.insert(END, data['Tool_name'])
                print(data['Tool_name'])
        file_tooli.close()
        save_tools_issued()
        # --------------------

    def return_page():
        global window2
        global listbox2
        
        window2=tk.Toplevel(master)
        window2.minsize(1000,500)
        window2.geometry("220x80")
        
        listbox2=Listbox(window2)
        listbox2.pack(padx=35, pady=40)
        listbox2.place(x=450, y=100)
    
        global text2
        text2=Text(window2)
        text2.config(state="normal")
        text2.place(x=100,y=100)
        text2.pack()

        #ok_btn=tk.Button(window2, fg="black", bg="white", text="OK", command=get_tool_names_r)
        #ok_btn.place(x=200, y=400)
        
        save_btn=tk.Button(window2, fg="black", bg="white", text="SAVE", command=get_tool_names_r)
        save_btn.place(x=400, y=400)
        
       #----------------------------

    def get_tool_names_r():
        print("RETURN")
        file_tooli=open(r"toolcode.txt","r+")
        to_write =text2.get("1.0",END)
        file_tooli.write(to_write)
        #print(to_write,"1")
        text=list(to_write.split("\n"))
        chunk=9
        for x in range(len(text)-1):
            bar=text[x]
            print(bar)
            if(len(bar)<chunk):
                break
            # get tool name from database
            URL='http://192.168.43.81/sma/APIs/toolname_api.php'
            print(URL)
            PARAMS = {'barcode':bar}
            r = requests.get(url = URL,params=PARAMS)
            #print(r.content)
            data = r.json()
            #print(data)
            if(data['Tool_name']=="null"):
                #listbox2.insert(END, "Invalid barcode")
                print("Invalid barcode")
            else:
                #listbox2.insert(END, data['Tool_name'])
                print(data['Tool_name'])
        file_tooli.close()
        save_tools_returned()

    # ----------------------

    def save_tools_issued():
        print("SAVING...(Issued tools)")
        file_tooli=open(r"toolcodeissue.txt","r+")
         # read from listbox continuously to get barcodes
        chunk=9     #assuming 9 is the number of digits in the bar code
        while True:
            barcode = file_tooli.readline()
            if len(barcode)<chunk:
                #print("ERROR")
                break
            #print(barcode)
            #listbox1.insert(END, data)
            time.sleep(1)
            # get tool name from database
            URL='http://192.168.43.81/sma/APIs/toolname_api.php'
            #print(URL)
            PARAMS = {'barcode':barcode}
            r1 = requests.get(url = URL,params=PARAMS)
            #print(r1) 
            data = r1.json()
            #print(data)
            if(data['Tool_name']=="null"):
                print("Invalid barcode")   
            else:
                #print(barcode)
                # insert barcode into database
                URL='http://192.168.43.81/sma/APIs/toolexit_api.php'
                PARAMS = {'barcode':barcode, 'stu_id':student_id}
                #print(URL)
                r2 = requests.get(url = URL, params = PARAMS) 
                data = r2.json()
                #print(data)
                
                
        print("Success:SAVED")
        master.destroy()
        file_tooli.close()
        #return

        #----------------------------------

    def save_tools_returned():
        print("SAVING....(Return tools)")
        file_tooli=open(r"toolcode.txt","w+")
         # read from listbox continuously to get barcodes
        chunk=9     #assuming 9 is the number of digits in the bar code
        while True:
            barcode = file_tooli.readline()
            if len(barcode)<chunk:
                break
            time.sleep(1)
            # get tool name from database
            URL='http://192.168.43.81/sma/APIs/toolname_api.php'
            PARAMS = {'barcode':barcode}
            r = requests.get(url = URL, params = PARAMS) 
            data1 = r.json()
            if(data1['Tool_name']=="null"):
                print("Invalid barcode") 
            else:
                # insert barcode into database
                URL='http://192.168.43.81/sma/APIs/toolexitreturn_api.php'
                PARAMS = {'barcode':barcode, 'stu_id':student_id}
                r3 = requests.get(url = URL, params = PARAMS) 
                #data2 = r3.json()
                #return_details.insert(window3.END,data1['Tool_name'])

        print("SUCCESS:SAVED")
        file_tooli.close()
        master.destroy()


        #------------------------------------

    #widgets in main window of GUI
    master=tk.Tk()
    master.minsize(1000,500)
    master.geometry("220x80")
    
    welcome_msg= tk.Label(master, text="ISSUE/RETURN")
    welcome_msg.pack(padx=20,pady=20)
    
    details=tk.Text(master, height=10, width=10)
    details.pack(padx=10,pady=5)
    details.insert(tk.END,result)
    
    issue_btn=tk.Button(master, fg="black", bg="white", text="ISSUE", command=issue_page)
    issue_btn.place(x=200, y=300)
        
    return_btn=tk.Button(master, text="RETURN", command=return_page)
    return_btn.place(x=700, y=300)
    
    tk.mainloop()
    
try:
        
        while True:
            mainfunc()
            

#else:
    #print("Some error please try again")
    #print("++++++++++++++++++++++++++++++++++++++++++++++")
    #mainfunc()

finally:
        GPIO.cleanup()
