text = "X-DSPAM-Confidence:    0.8475";
pos = text.find(':')
slicing = text[pos+5:]
floatValue = float(slicing)

print (floatValue)
