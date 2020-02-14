import requests
URL='http://127.0.0.1/sma/APIs/toolname_api.php'
barcode=123456789
PARAMS = {'barcode':barcode}
r = requests.get(url = URL, params = PARAMS) 
data = r.json()
if(data['stu_id']=='0'):
    print('not authorized')
else:
    print(data['name'])
