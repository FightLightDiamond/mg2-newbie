# Rest API

## Generate the admin token
Log in to Admin and go to Stores > Settings > Configuration > Services > OAuth > Access Token Expiration > Admin Token Lifetime (hours).

### Endpoint:
```
POST <host>/rest/<store_code?>/V1/integration/admin/token
```

### Headers:
```
Content-Type application/json
```

Payload:
```
{
"username": "admin",
"password": "123123"
}
```
Response:
```
bqu7bdsquyo3ngx3j06tsl7vid8wgi93
```
