import RPi.GPIO as GPIO
import time
import requests
import threading
import MySQLdb
import serial
import re

def connect():
    db = MySQLdb.connect("192.168.43.110","abc","123","building_maintenance" )
    return db

def disconnect(db):
    db.close()
    

doorIr = 16
boom = 40
indicator = 36
greenindicator = 32
carIr1 = 22
carIr2 = 21
ldr1 = 11
ldr2 = 7
mainlight = 13
cir1 = 37
cir2 = 33
cir3 = 31
cir4 = 29
cled1 = 15
cled2 = 26
cled3 = 24
cled4 = 18
secdoor = 12


GPIO.setmode(GPIO.BOARD)

GPIO.setup(doorIr,GPIO.IN)
GPIO.setup(carIr1,GPIO.IN)
GPIO.setup(carIr2,GPIO.IN)

GPIO.setup(indicator,GPIO.OUT)
GPIO.setup(greenindicator,GPIO.OUT)
GPIO.setup(mainlight,GPIO.OUT)
GPIO.setup(cir1,GPIO.IN)
GPIO.setup(cir2,GPIO.IN)
GPIO.setup(cir3,GPIO.IN)
GPIO.setup(cir4,GPIO.IN)

GPIO.setup(cled1,GPIO.OUT)
GPIO.setup(cled2,GPIO.OUT)
GPIO.setup(cled3,GPIO.OUT)
GPIO.setup(cled4,GPIO.OUT)
GPIO.setup(boom,GPIO.OUT)
GPIO.setup(secdoor,GPIO.OUT)


GPIO.output(indicator,False)
GPIO.output(greenindicator,False)
GPIO.setwarnings(False)


flagx = 0


#urlread = "https://api.thingspeak.com/channels/866474/feeds.json"
#urlwrite = "https://api.thingspeak.com/update"
#param = {'api_key':'W8Y1NQV07P6FBKS0','results':1}

def Parking():

    p = GPIO.PWM(boom, 50)
    p.start(2.5)
    
    def checkParking():
        db= connect()
        cursor = db.cursor()
        print("connected")
        while True:
            
            if GPIO.input(carIr1):
                
                cursor.execute("UPDATE parking SET filled = 0 where id = 2")
                
                db.commit()
            else:
                
                cursor.execute("UPDATE parking SET filled = 1 where id = 2")
                db.commit()
                
            if GPIO.input(carIr2):
                cursor.execute("UPDATE parking SET filled = 0 where id = 1")
                db.commit()
            else:
                
                cursor.execute("UPDATE parking SET filled = 1 where id = 1")
                db.commit()
        disconnect(db)
    checkparkingT = threading.Thread(target = checkParking)
    checkparkingT.start()
            
    def ledBlink():
        count = 0
        while True:
            if(count == 3):
                break
            time.sleep(0.2)
            if GPIO.input(doorIr):
                break
            if(count==0):
                GPIO.output(indicator,True)
                time.sleep(0.3)
            GPIO.output(indicator,True)
            time.sleep(0.1)
            GPIO.output(indicator,False)
            time.sleep(0.1)
            count+=1
        
                       
    while True:
        db2 = connect()
        cursor2 = db2.cursor()
        if not GPIO.input(doorIr):  
          count = 0
          t2 = threading.Thread(target = ledBlink)
          t2.start()
          cursor2.execute("SELECT filled from parking")
          data = cursor2.fetchall()
          data1,data2 = data[0][0],data[1][0]
          t2.join()
          if(data1 ==1 and data2 == 1):
              GPIO.output(indicator,True)
              time.sleep(2)
          else:
              GPIO.output(indicator,False)
              GPIO.output(greenindicator,True)
              p.ChangeDutyCycle(7.5)
              time.sleep(3)
        else:
            GPIO.output(indicator,False)
            GPIO.output(greenindicator,False)
            p.ChangeDutyCycle(2.5)
        disconnect(db2)
            
            
def CorridorLighting():
    def checklight():
        db = connect()
        cursor = db.cursor()
        def rc_time (pin_to_circuit):
            count = 0
          
            #Output on the pin for 
            GPIO.setup(pin_to_circuit, GPIO.OUT)
            GPIO.output(pin_to_circuit, GPIO.LOW)
            GPIO.setup(pin_to_circuit, GPIO.OUT)
            GPIO.output(pin_to_circuit, GPIO.LOW)
            time.sleep(0.1)

            #Change the pin back to input
            GPIO.setup(pin_to_circuit, GPIO.IN)
          
            #Count until the pin goes high
            while (GPIO.input(pin_to_circuit) == GPIO.LOW):
                count += 1

            return count
        flag = 0
        while True:
            
            count1 = rc_time(7)
            count2 = rc_time(11)
            if(count1>1000 or count2 > 1000):
                GPIO.output(mainlight,True)
                cursor.execute("UPDATE lights_status SET status = 1 where light_no = 1")
                db.commit()
                if flag == 0:
                    cursor.execute("INSERT INTO corridor_lighting(status) VALUES(1)")
                    db.commit()
                    flag = 1
                if not GPIO.input(cir1):
                    GPIO.output(cled1,True)
                    cursor.execute("UPDATE lights_status SET status = 1 where light_no = 2")
                    db.commit()
                else:
                    GPIO.output(cled1,False)
                    cursor.execute("UPDATE lights_status SET status = 0 where light_no = 2")
                    db.commit()
                if not GPIO.input(cir2):
                    GPIO.output(cled2,True)
                    cursor.execute("UPDATE lights_status SET status = 1 where light_no = 3")
                    db.commit()
                else:
                    GPIO.output(cled2,False)
                    cursor.execute("UPDATE lights_status SET status = 0 where light_no = 3")
                    db.commit()
                if not GPIO.input(cir3):
                    GPIO.output(cled3,True)
                    cursor.execute("UPDATE lights_status SET status = 1 where light_no = 4")
                    db.commit()
                else:
                    GPIO.output(cled3,False)
                    cursor.execute("UPDATE lights_status SET status = 0 where light_no = 4")
                    db.commit()
                if not GPIO.input(cir4):
                    GPIO.output(cled4,True)
                    cursor.execute("UPDATE lights_status SET status = 1 where light_no = 5")
                    db.commit()
                else:
                    GPIO.output(cled4,False)
                    cursor.execute("UPDATE lights_status SET status = 0 where light_no = 5")
                    db.commit()
            else:
                GPIO.output(mainlight,False)
                GPIO.output(cled4,False)
                GPIO.output(cled3,False)
                GPIO.output(cled2,False)
                GPIO.output(cled1,False)
                cursor.execute("UPDATE lights_status SET status = 0")
                db.commit()
                if flag == 1:
                    cursor.execute("INSERT INTO corridor_lighting(status) VALUES(0)")
                    db.commit()
                    flag = 0
                    
                
    t6 = threading.Thread(target = checklight)
    t6.start()
    
    
def Security():
    db = connect()
    cursor = db.cursor()
    p = GPIO.PWM(secdoor, 50)
    p.start(2.5)
    flag2 = 0
    ser = serial.Serial('/dev/ttyACM1', 9600, timeout = 0)
    global flagx
    
    def openservo(conn,cursor,data):
        print('opening')
        global flagx
        flagx = 1
        p.ChangeDutyCycle(7.5)
        time.sleep(3)
        while(flag2 == 1):
            pass
        cursor.execute("Insert into entrysecurity(userId) values(%s)"%data[0]);
        conn.commit();
        print('closing')
        p.ChangeDutyCycle(2.5)
        flagx = 0
    
    
    while(True):
        bytedata = ser.readline()
        data = re.findall('\d*',str(bytedata))
        try:
            if(data[0]!=''):
                flag2 = 1
                if flagx == 0:
                   openservot = threading.Thread(target = openservo,args = (db,cursor,data,))
                   openservot.start()
            else:
                time.sleep(1)
                flag2 = 0
        except:
            pass
        time.sleep(1)


t5 = threading.Thread(target = CorridorLighting)
t5.start()    
t4 = threading.Thread(target = Parking)
t4.start()
t6 = threading.Thread(target = Security)
t6.start()
