# Authentication

APIs for managing authentication

## User login




> Example request:

```bash
curl -X POST \
    "http://scim.test/api/auth/login" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"email":"jdoe@example.com","password":"TheBoyIsGoingToSchool#1992"}'

```

```javascript
const url = new URL(
    "http://scim.test/api/auth/login"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "jdoe@example.com",
    "password": "TheBoyIsGoingToSchool#1992"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json

{
"code": 200,
"data": {
   "name": "Joe Doe",
   "email": "jdoe@example.com",
   "avatar": "http://scim.test/storage/images/john-doe-12345432.jpg",
   "token": eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJuYW1lIjoiSm9obiBEb2UifQ.DjwRE2jZhren2Wt37t5hlVru6Myq4AhpGLiiefF69u8
 }
}
```
> Example response (422, Validation error(s)):

```json

{
 "errors": [
 "email": [
   "The email field is required",
   "The email field must be a valid email address"
 ],
 "password" : ["The password field is required"]
 ]
}
```
> Example response (400, Incorrect credentials):

```json
{
    "message": "Incorrect credentials provided"
}
```

### Request
<small class="badge badge-black">POST</small>
 **`api/auth/login`**

<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<code><b>email</b></code>&nbsp; <small>string</small>     <br>
    The email address of the user.

<code><b>password</b></code>&nbsp; <small>string</small>     <br>
    The password of the user.



## Request user password reset




> Example request:

```bash
curl -X POST \
    "http://scim.test/api/auth/password-reset" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://scim.test/api/auth/password-reset"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### Request
<small class="badge badge-black">POST</small>
 **`api/auth/password-reset`**



## View current authenticated user

<small class="badge badge-darkred">requires authentication</small>



> Example request:

```bash
curl -X GET \
    -G "http://scim.test/api/auth/user" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://scim.test/api/auth/user"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### Request
<small class="badge badge-green">GET</small>
 **`api/auth/user`**



## Logout current authenticated user

<small class="badge badge-darkred">requires authentication</small>



> Example request:

```bash
curl -X POST \
    "http://scim.test/api/auth/logout" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://scim.test/api/auth/logout"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### Request
<small class="badge badge-black">POST</small>
 **`api/auth/logout`**




