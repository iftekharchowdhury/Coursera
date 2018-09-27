
name = input("Enter file:")
if len(name) < 1 : name = "mbox-short.txt"
handle = open(name)
count = dict()

for line in handle:
    words = line.split()
    if len(words) == 0: 
        continue
    if words[0] != 'From:':
        continue
    #print(words[1])
    for word in words[1:]:
      count[word] = count.get(word, 0)+1
bigcount = None
bigword = None
for word, count in count.items():
    if bigcount is None or count>bigcount:
        bigword = word
        bigcount=count
        
print(bigword,bigcount)
