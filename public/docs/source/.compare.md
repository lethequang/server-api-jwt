---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://localhost/docs/collection.json)

<!-- END_INFO -->

#general
<!-- START_a925a8d22b3615f12fca79456d286859 -->
## Get a JWT via given credentials.

> Example request:

```bash
curl -X POST "http://localhost/api/auth/login" 
```

```javascript
const url = new URL("http://localhost/api/auth/login");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


### HTTP Request
`POST api/auth/login`


<!-- END_a925a8d22b3615f12fca79456d286859 -->

<!-- START_19ff1b6f8ce19d3c444e9b518e8f7160 -->
## Log the user out (Invalidate the token).

> Example request:

```bash
curl -X POST "http://localhost/api/auth/logout" 
```

```javascript
const url = new URL("http://localhost/api/auth/logout");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


### HTTP Request
`POST api/auth/logout`


<!-- END_19ff1b6f8ce19d3c444e9b518e8f7160 -->

<!-- START_994af8f47e3039ba6d6d67c09dd9e415 -->
## Refresh a token.

> Example request:

```bash
curl -X POST "http://localhost/api/auth/refresh" 
```

```javascript
const url = new URL("http://localhost/api/auth/refresh");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


### HTTP Request
`POST api/auth/refresh`


<!-- END_994af8f47e3039ba6d6d67c09dd9e415 -->

<!-- START_a47210337df3b4ba0df697c115ba0c1e -->
## Get the authenticated User.

> Example request:

```bash
curl -X POST "http://localhost/api/auth/me" 
```

```javascript
const url = new URL("http://localhost/api/auth/me");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


### HTTP Request
`POST api/auth/me`


<!-- END_a47210337df3b4ba0df697c115ba0c1e -->

<!-- START_3e0343a6abc18c3fa548b186378578ab -->
## api/user/show-all
> Example request:

```bash
curl -X GET -G "http://localhost/api/user/show-all" 
```

```javascript
const url = new URL("http://localhost/api/user/show-all");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
{
    "code": 401,
    "msg": "Token is empty"
}
```

### HTTP Request
`GET api/user/show-all`


<!-- END_3e0343a6abc18c3fa548b186378578ab -->

<!-- START_4983ccc4b1afb5213e7780701a29e411 -->
## api/user/detail/{id}
> Example request:

```bash
curl -X GET -G "http://localhost/api/user/detail/1" 
```

```javascript
const url = new URL("http://localhost/api/user/detail/1");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
{
    "code": 401,
    "msg": "Token is empty"
}
```

### HTTP Request
`GET api/user/detail/{id}`


<!-- END_4983ccc4b1afb5213e7780701a29e411 -->

<!-- START_683ca023a9c1ca269b193b86e0d9eeea -->
## api/user/remove/{id}
> Example request:

```bash
curl -X DELETE "http://localhost/api/user/remove/1" 
```

```javascript
const url = new URL("http://localhost/api/user/remove/1");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


### HTTP Request
`DELETE api/user/remove/{id}`


<!-- END_683ca023a9c1ca269b193b86e0d9eeea -->

<!-- START_d91291da69eb29ed55d5e15938ad3299 -->
## api/user/update/{id}
> Example request:

```bash
curl -X PUT "http://localhost/api/user/update/1" 
```

```javascript
const url = new URL("http://localhost/api/user/update/1");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


### HTTP Request
`PUT api/user/update/{id}`


<!-- END_d91291da69eb29ed55d5e15938ad3299 -->

<!-- START_0020113e217485e90d46685c7015fa49 -->
## api/user/create
> Example request:

```bash
curl -X POST "http://localhost/api/user/create" 
```

```javascript
const url = new URL("http://localhost/api/user/create");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


### HTTP Request
`POST api/user/create`


<!-- END_0020113e217485e90d46685c7015fa49 -->


