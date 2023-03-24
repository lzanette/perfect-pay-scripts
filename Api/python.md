Para conectar você precisa do access_token

Pegue ele conectando ao sistema pela api: 


```
import http.client
import json

conn = http.client.HTTPSConnection("app.perfectpay.com.br")
payload = json.dumps({
  "email": "EMAIL",
  "password": "SENHA"
})
headers = {
  'Content-Type': 'application/json',
}

conn.request("POST", "/api/auth/login", payload, headers)
res = conn.getresponse()
data = res.read()
print(data.decode("utf-8"))

```

### Vendas

O retorno do access_token use como  'Authorization': 'Bearer ' + data.access_token

Para buscar outras páginas basta você trocar o parâmetro página abaixo.

```
import http.client
import json

conn = http.client.HTTPSConnection("app.perfectpay.com.br")
payload = json.dumps({
  "start_date_sale": "2023-02-01",
  "end_date_sale": "2023-02-17",
  "page": 1,
  "sale_status": [
    1,
    2,
    3,
    4,
    5,
    6,
    7,
    10
  ]
})
headers = {
  'Accept': 'application/json',
  'Content-Type': 'application/json',
  'Authorization': 'Bearer ' + data.access_token
}
conn.request("POST", "/api/v2/sales/get", payload, headers)
res = conn.getresponse()
data = res.read()
print(data.decode("utf-8"))


```
