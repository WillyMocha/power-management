import mysql.connector
from antares_http import antares
from mysql.connector import Error

connection = mysql.connector.connect(host='localhost', database='ta', user='root', password='')
sql_select_Query = "select kwatt from token"
cursor = connection.cursor()
cursor.execute(sql_select_Query)
records = cursor.fetchall()
for row in records:
    token = row[0]
data = {
    "token": token
}
antares.setAccessKey('f0a8c253151082fa:a32e0b8df59ac9d6')
antares.send(data, 'power_management', 'token')
