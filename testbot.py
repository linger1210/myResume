import requests
headers = {'User-Agent': 'GPTBot'}
r = requests.get("https://leelinyuan.com", headers=headers)
print(r.status_code)