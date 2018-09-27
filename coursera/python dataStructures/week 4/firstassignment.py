fname = 'romeo.txt'
fh = open(fname)
lst = list()

for line in fh:
    lineStrip = line.rstrip()
    linewords = lineStrip.split()
    for words in linewords:
        if words not in lst:    
            lst.append(words)
      
print(sorted(lst))
        
          
