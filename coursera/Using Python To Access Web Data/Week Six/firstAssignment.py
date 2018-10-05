import urllib.request, urllib.parse, urllib.error
import json

url = 'http://py4e-data.dr-chuck.net/comments_134386.json'
uh = urllib.request.urlopen(url)
data = uh.read()
info = json.loads(data)
total=0
#print(info["comments"])
for item in info["comments"]:
    count_convert_int = int(item['count'])
    total = total + count_convert_int
print(total)
    #print(count_convert_int)
    #print(item['count'])

#print('User count:', len(info))
