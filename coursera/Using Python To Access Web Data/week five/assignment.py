import urllib.request, urllib.parse, urllib.error
import xml.etree.ElementTree as ET

url = 'http://py4e-data.dr-chuck.net/comments_134385.xml'
total = 0
uh = urllib.request.urlopen(url)
data = uh.read()

tree = ET.fromstring(data)

lst = tree.findall('comments/comment/count')
counts = tree.findall('.//count')

for each in counts:
    #print(each.text)

    value = int(each.text)
    total = total + value
print(total)

