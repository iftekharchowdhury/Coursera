'''
num  =0.0
tot = 0.0

while True:
    sval = input('Enter a number: ')
    if sval == 'done':
        break
    try:
        fval = float(sval)
    except:
        print ('Invalid input')
        continue
    num = num + 1
    tot = tot + fval

print (tot,num, tot/num)
'''

largest  = -1
smallest = None

while True:
    sval = input('Enter a number: ')
    if sval == 'done':
        break
    try:
        fval = int(sval)
    except:
        print ('Invalid input')
        continue
    
    if (fval > largest):
        largest = fval
    else:
        if (smallest is None):
            smallest = fval
        elif fval < smallest:
            smallest = fval
    

print ("Maximum is",largest)
print ("Minimum is",smallest)
