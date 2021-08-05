import mysql.connector
from antares_http import antares
from mysql.connector import Error

connection = mysql.connector.connect(host='localhost', database='ta', user='root', password='')
sql_select_Query = "select jam_rek from rekomendasi"
cursor = connection.cursor()
cursor.execute(sql_select_Query)
records = cursor.fetchall()
jam = [0 for i in range(10)]
no = 0
for row in records:
    jam[no] = row[0]
    print(jam[no])
    no=no+1
data = {
   "Device_1": jam[0],
    "Device_2": jam[1],
    "Device_3": jam[2],
    "Device_4": jam[3],
    "Device_5": jam[4],
    "Device_6": jam[5],
    "Device_7": jam[6],
    "Device_8": jam[7],
    "Device_9": jam[8],
    "Device_10": jam[9],
}
    
antares.setAccessKey('2e260a2476541f43:96a008f8368d4875')
antares.send(data, 'PowerManagement', 'rekomendasi')
