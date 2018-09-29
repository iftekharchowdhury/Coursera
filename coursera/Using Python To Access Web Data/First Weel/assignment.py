import re

handle = open('file2.txt')
count = 0
total = 0

for line in handle:
    line = line.rstrip()

    #x = re.findall('^X-.*: ([0-9.]+)', line)
    #x = re.findall('^Details:.*rev=([0-9].+)', line)
    #x = re.findall('^From .* ([0-9][0-9]):', line)
    x = re.findall('[0-9]+', line)

    for value in x:
        y = float(value)
        #print(y)
        total = total + y
        count = count+1
print(total)
print(count)

'''
print("Total:",total)
print("value:",total/count)
'''
