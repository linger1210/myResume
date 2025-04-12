import requests
import time

url = "https://leelinyuan.com/test.html"

# Sleep 15 seconds before testing to reset previous block
print("Waiting 15 seconds to clear any existing block...")
time.sleep(15)

for i in range(5):
    r = requests.get(url)
    print(f"{i+1}: {r.status_code}")
    time.sleep(2)  # change this to control rate
