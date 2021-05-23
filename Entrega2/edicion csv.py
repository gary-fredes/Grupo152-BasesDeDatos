with open('direcciones.csv') as direcciones:
    for line in direcciones:
        line = line.split(",")
        print(line)