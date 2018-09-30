import urllib.request, urllib.parse, urllib.error
from bs4 import BeautifulSoup
import ssl

count = 0
total = 0
ctx = ssl.create_default_context()
ctx.check_hostname = False
ctx.verify_mode = ssl.CERT_NONE

url = input('Enter - ')
html = urllib.request.urlopen(url, context=ctx).read()
soup = BeautifulSoup(html, 'html.parser')

tags = soup('span')
for tag in tags:
    #print(type(tag.get_text()))
    get_value = tag.get_text()
    val = float(get_value)
    #print(val)
    total = val+total
    count = count + 1
    
print(total)
print(count)
    
    
