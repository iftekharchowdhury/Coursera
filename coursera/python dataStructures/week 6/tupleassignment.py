name = input("Enter file:")
if len(name) < 1: name= "mbox-short.txt"

fhandle = open(name)
counts = dict()

for line in fhandle:
    words = line.split()
    if len(words) == 0:
        continue
    if words[0] != 'From':
        continue

    words = words[5].split(':')
    #print(words[0])
    #for word in words[:1]:
        #print(word)
    

    
    for word in words[:1]:
        counts[word]=counts.get(word,0)+1

lst = list()

for k, v in counts.items():
    newtpl = (k, v)
    #print(newtpl)
    lst.append(newtpl)
    
#print(lst)
lst = sorted(lst)
#print(lst)

for v, k in lst:
    print(v, k)

