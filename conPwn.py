#coding:utf8
'''
Created on 2016年8月23日

@author: yangshenghui
'''
import re
from socket import *
from time import sleep
import sys
# from threading import *
# 
# screenLock = Semaphore(value = 1)

def connect(tgtHost,tgtPort):
    try:
        tgtPort = int(tgtPort)
        connSkt = socket(AF_INET,SOCK_STREAM)
        connSkt.connect((tgtHost,tgtPort))
    except:
        return None
    else:
        return connSkt
# compare the weight    
def weight(cIndex, cWeight, lIndex):  
    if cWeight != (cIndex[1]-cIndex[0])*10:  
        return cIndex  
    else:  
        return (cIndex[1],lIndex[1])  
# format the index range to string  
def getNumbers(index):  
    strList = []  
    for i in range(index[0], index[1]):  
        strList.append(str(i))  
    return ' '.join(strList)  

    
def main():
    tgtHost = 'pwnable.kr'
    tgtPort = 9007
    count = 0
    index = None 
    lastIndex = None # the range that contains the counterfeit coin 
    con = connect("pwnable.kr", 9007)
    if con == None:
        print '[-]Error'
        sys.exit(1)
    else:
        while count<100:
            content = con.recv(1024) 
            print str(content)   
            pattern1 = re.compile("""^N=([0-9]*) C=([0-9]*)$""")  
            num = pattern1.match(str(content))  
          
            pattern2 = re.compile("""^([0-9]*)$""")  
            acceptWeight = pattern2.match(str(content))
            #when receive N=787 C=10
            if num:  
                index = (0,int(num.group(1))/2)  
                lastIndex = (0, int(num.group(1)))  
                print str(getNumbers(index))  
                con.send(getNumbers(index) + "\r\n")  
            # when receive 393 
            elif acceptWeight and len(acceptWeight.group(1)) > 0:  
                lastIndex=weight(index, int(acceptWeight.group(1)), lastIndex)  
                index=(lastIndex[0], (lastIndex[0]+lastIndex[1])/2 + (lastIndex[0]+lastIndex[1])%2) # get the ceil value when divided by 2  
                print str(getNumbers(index))  
                con.send(getNumbers(index) + "\r\n")  
            elif "format error" in str(content) or "time expired! bye!" in str(content):  
                break  
    con.close()  
if __name__ == '__main__':
    main()
        