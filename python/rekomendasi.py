import numpy as np
import pandas as pd
import random as rd
from random import randint
import matplotlib.pyplot as plt
import mysql.connector
from mysql.connector import Error

#Inisialisasi Kromosom
def random_population(no, jam, daily_token):
    rows, cols = (no, no) 
    arr=[]
    if(daily_token <= 30):
        for i in range(cols):
            col = [] 
            for j in range(rows):
                if(j == 0):
                    if(jam[j] == 0):
                        col.append(rd.randint(1,11))
                    else:
                        col.append(24)
                elif (j == 1):
                    if(jam[j] == 0):
                        col.append(rd.randint(1,10))
                    else:
                        col.append(24)
                elif (j == 2):
                    if(jam[j] == 0):
                        col.append(rd.randint(1,9))
                    else:
                        col.append(24)
                elif (j == 3):
                    if(jam[j] == 0):
                        col.append(rd.randint(1,8))
                    else:
                        col.append(24)
                elif (j == 4):
                    if(jam[j] == 0):
                        col.append(rd.randint(1,7))
                    else:
                        col.append(24)
                elif (j == 5):
                    if(jam[j] == 0):
                        col.append(rd.randint(1,6))
                    else:
                        col.append(24)
                elif (j == 6):
                    if(jam[j] == 0):
                        col.append(rd.randint(1,5))
                    else:
                        col.append(24)
                elif (j == 7):
                    if(jam[j] == 0):
                        col.append(rd.randint(1,4))
                    else:
                        col.append(24)
                elif (j == 8):
                    if(jam[j] == 0):
                        col.append(rd.randint(1,3))
                    else:
                        col.append(24)
                elif (j == 9):
                    if(jam[j] == 0):
                        col.append(rd.randint(1,2))
                    else:
                        col.append(24)
            arr.append(col)
            a = np.array(arr)
    else:
        for i in range(cols):
            col = [] 
            for j in range(rows):
                if(j == 0):
                    if(jam[j] == 0):
                        col.append(rd.randint(18,24))
                    else:
                        col.append(24)
                elif (j == 1):
                    if(jam[j] == 0):
                        col.append(rd.randint(16,22))
                    else:
                        col.append(24)
                elif (j == 2):
                    if(jam[j] == 0):
                        col.append(rd.randint(14,20))
                    else:
                        col.append(24)
                elif (j == 3):
                    if(jam[j] == 0):
                        col.append(rd.randint(12,18))
                    else:
                        col.append(24)
                elif (j == 4):
                    if(jam[j] == 0):
                        col.append(rd.randint(10,16))
                    else:
                        col.append(24)
                elif (j == 5):
                    if(jam[j] == 0):
                        col.append(rd.randint(8,14))
                    else:
                        col.append(24)
                elif (j == 6):
                    if(jam[j] == 0):
                        col.append(rd.randint(6,12))
                    else:
                        col.append(24)
                elif (j == 7):
                    if(jam[j] == 0):
                        col.append(rd.randint(4,10))
                    else:
                        col.append(24)
                elif (j == 8):
                    if(jam[j] == 0):
                        col.append(rd.randint(2,8))
                    else:
                        col.append(24)
                elif (j == 9):
                    if(jam[j] == 0):
                        col.append(rd.randint(1,6))
                    else:
                        col.append(24)

            arr.append(col)
            a = np.array(arr)
    print(a)
    return a

#Evaluasi Kromosom
def cal_fitness(weight, value, population, threshold):
    fitness = np.empty(population.shape[0])
    for i in range(population.shape[0]):
        #Jumlahkan isi (gen) nilai / value dari prioritas per kromosom
        S1 = np.sum(population[i] * value)
        #print('value: \n{}\n'.format(S1))
        #Jumlahkan isi (gen) berat (total daya) per kromosom
        S2 = np.sum(population[i] * weight)
        #print('weight: \n{}\n'.format(S2))
        #Syarat jika daya <= sisa kWh, maka prioritas jadi nilai fitness
        if S2 <= threshold:
            fitness[i] = S1
        else :
            fitness[i] = 0 
    return fitness.astype(int)

#Seleksi Kromosom (Tournament Selection)
def selection(fitness, num_parents, population):
    #Memanggil nilai fitness
    #List, https://stackoverflow.com/questions/30515300/python-how-does-list0-0-differ-from-0-0
    fitness = list(fitness)
    #Deklarasi variabel parents
    #numpy.empty(shape, dtype = float, order = 'C') : Return a new array of given shape and type, with random values.
    parents = np.empty((num_parents, population.shape[1]))
    #num_parents = populasi/2, sama dengan dipasangkan
    for i in range(num_parents):
        #Mencari kromosom dengan nilai fitness terbersar
        #np.max, https://stackoverflow.com/questions/33569668/numpy-max-vs-amax-vs-maximum
        max_fitness_idx = np.where(fitness == np.max(fitness))
        #print ('Max fitness = ', max_fitness_idx)
        parents[i,:] = population[max_fitness_idx[0][0], :]
        #print ('parents[i,:] = ', parents[i,:])
        fitness[max_fitness_idx[0][0]] = -999999
        #print ('fitness[max_fitness_idx[0][0]] = ', fitness[max_fitness_idx[0][0]])
    return parents

#One-Point Crossover
def crossover(parents, num_offsprings):
    #Inisialisasi variabel kromosom hasil crossover
    offsprings = np.empty((num_offsprings, parents.shape[1]))
    #I
    crossover_point = int(parents.shape[1]/2)
    crossover_rate = 0.4
    i=0
    while (parents.shape[0] < num_offsprings):
        parent1_index = i%parents.shape[0]
        parent2_index = (i+1)%parents.shape[0]
        x = rd.random()
        if x > crossover_rate:
            continue
        parent1_index = i%parents.shape[0]
        parent2_index = (i+1)%parents.shape[0]
        offsprings[i,0:crossover_point] = parents[parent1_index,0:crossover_point]
        offsprings[i,crossover_point:] = parents[parent2_index,crossover_point:]
        #print("Offspring: ", offsprings[i,crossover_point:])
        i=+1
    return offsprings

#Mutasi
def mutation(offsprings):
    mutants = np.empty((offsprings.shape))
    mutation_rate = 0.4
    for i in range(mutants.shape[0]):
        random_value = rd.random()
        mutants[i,:] = offsprings[i,:]
        if random_value > mutation_rate:
            continue
        int_random_value = randint(0,offsprings.shape[1]-1)
        #print (int_random_value)
        if mutants[i,int_random_value] == 0 :
            mutants[i,int_random_value] = 1
    return mutants

def optimize(weight, value, population, pop_size, num_generations, threshold, solution_per_pop):
    parameters, fitness_history = [], []
    num_parents = int(pop_size[0]/2)
    num_offsprings = pop_size[0] - num_parents 
    for i in range(num_generations):
        fitness = cal_fitness(weight, value, population, threshold)
        fitness_history.append(fitness)
        parents = selection(fitness, num_parents, population)
        offsprings = crossover(parents, num_offsprings)
        for x in range(num_parents):
            for v in range (solution_per_pop):
                S3 = np.sum(offsprings[x] * weight)
                S3 = float(S3)
                y = (solution_per_pop - 1) - v
                if S3 > threshold:
                    offsprings[x,y] = 0
                S4 = np.sum(offsprings[x] * weight)
        print('Hasil cross', offsprings)
        print('Weight cross', S4)
        print('\n\n')
        
        mutants = mutation(offsprings)
        for s in range(num_parents):
            for d in range (solution_per_pop):
                S5 = np.sum(mutants[s] * weight)
                S5 = float(S5)
                f = (solution_per_pop - 1) - d
                if S5 > threshold:
                    mutants[s,f] = 0
                S6 = np.sum(mutants[s] * weight)
        print('Hasil mutan', mutants)
        print('Weight mutan', S6)
        print('\n\n')
        
        population[0:parents.shape[0], :] = parents
        population[parents.shape[0]:, :] = mutants
        
    print('Last generation: \n{}\n'.format(population))
    for i in range(population.shape[0]):
        lw = np.sum(population[i] * weight)
    print('Last Weight: \n{}\n'.format(lw))
    fitness_last_gen = fitness      
    print('Fitness of the last generation: \n{}\n'.format(fitness_last_gen))
    max_fitness = np.where(fitness_last_gen == np.max(fitness_last_gen))
    parameters.append(population[max_fitness[0][0],:])
    return parameters, fitness_history

try:
    connection = mysql.connector.connect(
        host='localhost',
        database='ta',
        user='root',
        password='')

    sql_device = "SELECT device_pb.id_device_pb, device_pb.nama, device_pb.jam, device_pb.total_daya, pascabayar.kwatt, pascabayar.hari, device_pb.nilai FROM device_pb INNER JOIN pascabayar ON device_pb.username=pascabayar.username order by prioritas asc"
    cursor = connection.cursor()
    cursor.execute(sql_device)
    records = cursor.fetchall()
    print("Total Baris Pada Tabel Device: ", cursor.rowcount)
    
    #Inisialisasi
    print("\nDevice Record")
    
    idd = [0 for i in range(10)]
    daya = [0 for i in range(10)]
    jam = [0 for i in range(10)]
    value = [0 for i in range(10)]
    ip = [0 for i in range(10)]
    no = 0
    #Tabel Data
    print('ID          Device          Jam          Daya          Token          Hari          Value')
    for row in records:
        idd = row[0]
        device = row[1]
        jam[no] = row[2]
        daya[no] = row[3]
        token = row[4]
        hari = row[5]
        value[no] = row[6]
        no = no + 1
        print('{0}          {1}          {2}          {3}          {4}          {5}          {6}\n'.format(idd, device, jam, daya, token, hari, value))
        
        #Kromosom
        solution_per_pop = cursor.rowcount
        #populasi
        pop_size = (solution_per_pop, cursor.rowcount)
    
    #Threshold / Batas Daya
    daily_token = token / hari
    print ('Daya Listrik / Hari = ', daily_token , 'kWh')
    #daily_token = round(token / hari)
    #print ('Daya Listrik / Hari = ', daily_token , 'kWh')
    
    #Inisialisasi Populasi
    print('\nPopulation size = {}'.format(pop_size))
    #initial_population = np.random.randint(1,24, size = pop_size)
    #print('Initial population: \n{}'.format(initial_population))
    num_generations = 50
    
    initial_population = random_population(no, jam, daily_token)
    #print (initial_population)
    #print (ip)

except Error as e:
    print("Error reading data from MySQL table", e)
finally:
    if (connection.is_connected()):
        connection.close()
        cursor.close()
        print("MySQL connection is closed")

parameters, fitness_history = optimize(daya, value, initial_population, pop_size, num_generations, daily_token, solution_per_pop)
print('The optimized parameters for the given inputs are: \n{}'.format(parameters))

list_jam = [0 for i in range(10)]
list_jam = parameters[0]

for a in range (solution_per_pop):
    print('Device : ', list_jam[a])
    
for z in range (solution_per_pop):
    hehe = int(list_jam[z])
    connection = mysql.connector.connect(host='localhost', database='ta', user='root', password='')
    cursor = connection.cursor()
    sql_update = "UPDATE rekomendasi SET jam_rek = %s WHERE id_rek = %s"
    input_data = (hehe, z+1)
    cursor.execute(sql_update, input_data)
    connection.commit()