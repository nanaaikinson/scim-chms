# Endpoints


## docs.json




> Example request:

```bash
curl -X GET \
    -G "http://scim.test/docs.json" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://scim.test/docs.json"
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


> Example response (200):

```json
{
    "variables": [],
    "info": {
        "name": "Laravel API",
        "_postman_id": "5e1fbb2e-df20-47f6-9dcd-8efa4d83534a",
        "description": "",
        "schema": "https:\/\/schema.getpostman.com\/json\/collection\/v2.0.0\/collection.json"
    },
    "item": [
        {
            "name": "Authentication",
            "description": "\nAPIs for managing authentication",
            "item": [
                {
                    "name": "User login",
                    "request": {
                        "url": {
                            "protocol": "http",
                            "host": "scim.test",
                            "path": "api\/auth\/login",
                            "query": [],
                            "raw": "http:\/\/scim.test\/api\/auth\/login"
                        },
                        "method": "POST",
                        "header": [
                            {
                                "key": "Content-Type",
                                "value": "application\/json"
                            },
                            {
                                "key": "Accept",
                                "value": "application\/json"
                            }
                        ],
                        "body": {
                            "mode": "raw",
                            "raw": "{\n    \"email\": \"jdoe@example.com\",\n    \"password\": \"TheBoyIsGoingToSchool#1992\"\n}",
                            "options": {
                                "raw": {
                                    "language": "json"
                                }
                            }
                        },
                        "description": "",
                        "response": []
                    }
                },
                {
                    "name": "Request user password reset",
                    "request": {
                        "url": {
                            "protocol": "http",
                            "host": "scim.test",
                            "path": "api\/auth\/password-reset",
                            "query": [],
                            "raw": "http:\/\/scim.test\/api\/auth\/password-reset"
                        },
                        "method": "POST",
                        "header": [
                            {
                                "key": "Content-Type",
                                "value": "application\/json"
                            },
                            {
                                "key": "Accept",
                                "value": "application\/json"
                            }
                        ],
                        "body": {
                            "mode": "raw",
                            "raw": "[]",
                            "options": {
                                "raw": {
                                    "language": "json"
                                }
                            }
                        },
                        "description": "",
                        "response": []
                    }
                },
                {
                    "name": "View current authenticated user",
                    "request": {
                        "url": {
                            "protocol": "http",
                            "host": "scim.test",
                            "path": "api\/auth\/user",
                            "query": [],
                            "raw": "http:\/\/scim.test\/api\/auth\/user"
                        },
                        "method": "GET",
                        "header": [
                            {
                                "key": "Content-Type",
                                "value": "application\/json"
                            },
                            {
                                "key": "Accept",
                                "value": "application\/json"
                            }
                        ],
                        "body": {
                            "mode": "raw",
                            "raw": "[]",
                            "options": {
                                "raw": {
                                    "language": "json"
                                }
                            }
                        },
                        "description": "",
                        "response": []
                    }
                },
                {
                    "name": "Logout current authenticated user",
                    "request": {
                        "url": {
                            "protocol": "http",
                            "host": "scim.test",
                            "path": "api\/auth\/logout",
                            "query": [],
                            "raw": "http:\/\/scim.test\/api\/auth\/logout"
                        },
                        "method": "POST",
                        "header": [
                            {
                                "key": "Content-Type",
                                "value": "application\/json"
                            },
                            {
                                "key": "Accept",
                                "value": "application\/json"
                            }
                        ],
                        "body": {
                            "mode": "raw",
                            "raw": "[]",
                            "options": {
                                "raw": {
                                    "language": "json"
                                }
                            }
                        },
                        "description": "",
                        "response": []
                    }
                }
            ]
        },
        {
            "name": "Endpoints",
            "description": "",
            "item": [
                {
                    "name": "docs.json",
                    "request": {
                        "url": {
                            "protocol": "http",
                            "host": "scim.test",
                            "path": "docs.json",
                            "query": [],
                            "raw": "http:\/\/scim.test\/docs.json"
                        },
                        "method": "GET",
                        "header": [
                            {
                                "key": "Content-Type",
                                "value": "application\/json"
                            },
                            {
                                "key": "Accept",
                                "value": "application\/json"
                            }
                        ],
                        "body": {
                            "mode": "raw",
                            "raw": "[]",
                            "options": {
                                "raw": {
                                    "language": "json"
                                }
                            }
                        },
                        "description": "",
                        "response": []
                    }
                },
                {
                    "name": "Authorize a client to access the user's account.",
                    "request": {
                        "url": {
                            "protocol": "http",
                            "host": "scim.test",
                            "path": "oauth\/authorize",
                            "query": [],
                            "raw": "http:\/\/scim.test\/oauth\/authorize"
                        },
                        "method": "GET",
                        "header": [
                            {
                                "key": "Content-Type",
                                "value": "application\/json"
                            },
                            {
                                "key": "Accept",
                                "value": "application\/json"
                            }
                        ],
                        "body": {
                            "mode": "raw",
                            "raw": "[]",
                            "options": {
                                "raw": {
                                    "language": "json"
                                }
                            }
                        },
                        "description": "",
                        "response": []
                    }
                },
                {
                    "name": "Approve the authorization request.",
                    "request": {
                        "url": {
                            "protocol": "http",
                            "host": "scim.test",
                            "path": "oauth\/authorize",
                            "query": [],
                            "raw": "http:\/\/scim.test\/oauth\/authorize"
                        },
                        "method": "POST",
                        "header": [
                            {
                                "key": "Content-Type",
                                "value": "application\/json"
                            },
                            {
                                "key": "Accept",
                                "value": "application\/json"
                            }
                        ],
                        "body": {
                            "mode": "raw",
                            "raw": "[]",
                            "options": {
                                "raw": {
                                    "language": "json"
                                }
                            }
                        },
                        "description": "",
                        "response": []
                    }
                },
                {
                    "name": "Deny the authorization request.",
                    "request": {
                        "url": {
                            "protocol": "http",
                            "host": "scim.test",
                            "path": "oauth\/authorize",
                            "query": [],
                            "raw": "http:\/\/scim.test\/oauth\/authorize"
                        },
                        "method": "DELETE",
                        "header": [
                            {
                                "key": "Content-Type",
                                "value": "application\/json"
                            },
                            {
                                "key": "Accept",
                                "value": "application\/json"
                            }
                        ],
                        "body": {
                            "mode": "raw",
                            "raw": "[]",
                            "options": {
                                "raw": {
                                    "language": "json"
                                }
                            }
                        },
                        "description": "",
                        "response": []
                    }
                },
                {
                    "name": "Authorize a client to access the user's account.",
                    "request": {
                        "url": {
                            "protocol": "http",
                            "host": "scim.test",
                            "path": "oauth\/token",
                            "query": [],
                            "raw": "http:\/\/scim.test\/oauth\/token"
                        },
                        "method": "POST",
                        "header": [
                            {
                                "key": "Content-Type",
                                "value": "application\/json"
                            },
                            {
                                "key": "Accept",
                                "value": "application\/json"
                            }
                        ],
                        "body": {
                            "mode": "raw",
                            "raw": "[]",
                            "options": {
                                "raw": {
                                    "language": "json"
                                }
                            }
                        },
                        "description": "",
                        "response": []
                    }
                },
                {
                    "name": "Get all of the authorized tokens for the authenticated user.",
                    "request": {
                        "url": {
                            "protocol": "http",
                            "host": "scim.test",
                            "path": "oauth\/tokens",
                            "query": [],
                            "raw": "http:\/\/scim.test\/oauth\/tokens"
                        },
                        "method": "GET",
                        "header": [
                            {
                                "key": "Content-Type",
                                "value": "application\/json"
                            },
                            {
                                "key": "Accept",
                                "value": "application\/json"
                            }
                        ],
                        "body": {
                            "mode": "raw",
                            "raw": "[]",
                            "options": {
                                "raw": {
                                    "language": "json"
                                }
                            }
                        },
                        "description": "",
                        "response": []
                    }
                },
                {
                    "name": "Delete the given token.",
                    "request": {
                        "url": {
                            "protocol": "http",
                            "host": "scim.test",
                            "path": "oauth\/tokens\/:token_id",
                            "query": [],
                            "raw": "http:\/\/scim.test\/oauth\/tokens\/:token_id"
                        },
                        "method": "DELETE",
                        "header": [
                            {
                                "key": "Content-Type",
                                "value": "application\/json"
                            },
                            {
                                "key": "Accept",
                                "value": "application\/json"
                            }
                        ],
                        "body": {
                            "mode": "raw",
                            "raw": "[]",
                            "options": {
                                "raw": {
                                    "language": "json"
                                }
                            }
                        },
                        "description": "",
                        "response": []
                    }
                },
                {
                    "name": "Get a fresh transient token cookie for the authenticated user.",
                    "request": {
                        "url": {
                            "protocol": "http",
                            "host": "scim.test",
                            "path": "oauth\/token\/refresh",
                            "query": [],
                            "raw": "http:\/\/scim.test\/oauth\/token\/refresh"
                        },
                        "method": "POST",
                        "header": [
                            {
                                "key": "Content-Type",
                                "value": "application\/json"
                            },
                            {
                                "key": "Accept",
                                "value": "application\/json"
                            }
                        ],
                        "body": {
                            "mode": "raw",
                            "raw": "[]",
                            "options": {
                                "raw": {
                                    "language": "json"
                                }
                            }
                        },
                        "description": "",
                        "response": []
                    }
                },
                {
                    "name": "Get all of the clients for the authenticated user.",
                    "request": {
                        "url": {
                            "protocol": "http",
                            "host": "scim.test",
                            "path": "oauth\/clients",
                            "query": [],
                            "raw": "http:\/\/scim.test\/oauth\/clients"
                        },
                        "method": "GET",
                        "header": [
                            {
                                "key": "Content-Type",
                                "value": "application\/json"
                            },
                            {
                                "key": "Accept",
                                "value": "application\/json"
                            }
                        ],
                        "body": {
                            "mode": "raw",
                            "raw": "[]",
                            "options": {
                                "raw": {
                                    "language": "json"
                                }
                            }
                        },
                        "description": "",
                        "response": []
                    }
                },
                {
                    "name": "Store a new client.",
                    "request": {
                        "url": {
                            "protocol": "http",
                            "host": "scim.test",
                            "path": "oauth\/clients",
                            "query": [],
                            "raw": "http:\/\/scim.test\/oauth\/clients"
                        },
                        "method": "POST",
                        "header": [
                            {
                                "key": "Content-Type",
                                "value": "application\/json"
                            },
                            {
                                "key": "Accept",
                                "value": "application\/json"
                            }
                        ],
                        "body": {
                            "mode": "raw",
                            "raw": "[]",
                            "options": {
                                "raw": {
                                    "language": "json"
                                }
                            }
                        },
                        "description": "",
                        "response": []
                    }
                },
                {
                    "name": "Update the given client.",
                    "request": {
                        "url": {
                            "protocol": "http",
                            "host": "scim.test",
                            "path": "oauth\/clients\/:client_id",
                            "query": [],
                            "raw": "http:\/\/scim.test\/oauth\/clients\/:client_id"
                        },
                        "method": "PUT",
                        "header": [
                            {
                                "key": "Content-Type",
                                "value": "application\/json"
                            },
                            {
                                "key": "Accept",
                                "value": "application\/json"
                            }
                        ],
                        "body": {
                            "mode": "raw",
                            "raw": "[]",
                            "options": {
                                "raw": {
                                    "language": "json"
                                }
                            }
                        },
                        "description": "",
                        "response": []
                    }
                },
                {
                    "name": "Delete the given client.",
                    "request": {
                        "url": {
                            "protocol": "http",
                            "host": "scim.test",
                            "path": "oauth\/clients\/:client_id",
                            "query": [],
                            "raw": "http:\/\/scim.test\/oauth\/clients\/:client_id"
                        },
                        "method": "DELETE",
                        "header": [
                            {
                                "key": "Content-Type",
                                "value": "application\/json"
                            },
                            {
                                "key": "Accept",
                                "value": "application\/json"
                            }
                        ],
                        "body": {
                            "mode": "raw",
                            "raw": "[]",
                            "options": {
                                "raw": {
                                    "language": "json"
                                }
                            }
                        },
                        "description": "",
                        "response": []
                    }
                },
                {
                    "name": "Get all of the available scopes for the application.",
                    "request": {
                        "url": {
                            "protocol": "http",
                            "host": "scim.test",
                            "path": "oauth\/scopes",
                            "query": [],
                            "raw": "http:\/\/scim.test\/oauth\/scopes"
                        },
                        "method": "GET",
                        "header": [
                            {
                                "key": "Content-Type",
                                "value": "application\/json"
                            },
                            {
                                "key": "Accept",
                                "value": "application\/json"
                            }
                        ],
                        "body": {
                            "mode": "raw",
                            "raw": "[]",
                            "options": {
                                "raw": {
                                    "language": "json"
                                }
                            }
                        },
                        "description": "",
                        "response": []
                    }
                },
                {
                    "name": "Get all of the personal access tokens for the authenticated user.",
                    "request": {
                        "url": {
                            "protocol": "http",
                            "host": "scim.test",
                            "path": "oauth\/personal-access-tokens",
                            "query": [],
                            "raw": "http:\/\/scim.test\/oauth\/personal-access-tokens"
                        },
                        "method": "GET",
                        "header": [
                            {
                                "key": "Content-Type",
                                "value": "application\/json"
                            },
                            {
                                "key": "Accept",
                                "value": "application\/json"
                            }
                        ],
                        "body": {
                            "mode": "raw",
                            "raw": "[]",
                            "options": {
                                "raw": {
                                    "language": "json"
                                }
                            }
                        },
                        "description": "",
                        "response": []
                    }
                },
                {
                    "name": "Create a new personal access token for the user.",
                    "request": {
                        "url": {
                            "protocol": "http",
                            "host": "scim.test",
                            "path": "oauth\/personal-access-tokens",
                            "query": [],
                            "raw": "http:\/\/scim.test\/oauth\/personal-access-tokens"
                        },
                        "method": "POST",
                        "header": [
                            {
                                "key": "Content-Type",
                                "value": "application\/json"
                            },
                            {
                                "key": "Accept",
                                "value": "application\/json"
                            }
                        ],
                        "body": {
                            "mode": "raw",
                            "raw": "[]",
                            "options": {
                                "raw": {
                                    "language": "json"
                                }
                            }
                        },
                        "description": "",
                        "response": []
                    }
                },
                {
                    "name": "Delete the given token.",
                    "request": {
                        "url": {
                            "protocol": "http",
                            "host": "scim.test",
                            "path": "oauth\/personal-access-tokens\/:token_id",
                            "query": [],
                            "raw": "http:\/\/scim.test\/oauth\/personal-access-tokens\/:token_id"
                        },
                        "method": "DELETE",
                        "header": [
                            {
                                "key": "Content-Type",
                                "value": "application\/json"
                            },
                            {
                                "key": "Accept",
                                "value": "application\/json"
                            }
                        ],
                        "body": {
                            "mode": "raw",
                            "raw": "[]",
                            "options": {
                                "raw": {
                                    "language": "json"
                                }
                            }
                        },
                        "description": "",
                        "response": []
                    }
                },
                {
                    "name": "api\/public\/books",
                    "request": {
                        "url": {
                            "protocol": "http",
                            "host": "scim.test",
                            "path": "api\/public\/books",
                            "query": [],
                            "raw": "http:\/\/scim.test\/api\/public\/books"
                        },
                        "method": "GET",
                        "header": [
                            {
                                "key": "Content-Type",
                                "value": "application\/json"
                            },
                            {
                                "key": "Accept",
                                "value": "application\/json"
                            }
                        ],
                        "body": {
                            "mode": "raw",
                            "raw": "[]",
                            "options": {
                                "raw": {
                                    "language": "json"
                                }
                            }
                        },
                        "description": "",
                        "response": []
                    }
                },
                {
                    "name": "api\/books",
                    "request": {
                        "url": {
                            "protocol": "http",
                            "host": "scim.test",
                            "path": "api\/books",
                            "query": [],
                            "raw": "http:\/\/scim.test\/api\/books"
                        },
                        "method": "GET",
                        "header": [
                            {
                                "key": "Content-Type",
                                "value": "application\/json"
                            },
                            {
                                "key": "Accept",
                                "value": "application\/json"
                            }
                        ],
                        "body": {
                            "mode": "raw",
                            "raw": "[]",
                            "options": {
                                "raw": {
                                    "language": "json"
                                }
                            }
                        },
                        "description": "",
                        "response": []
                    }
                },
                {
                    "name": "api\/books",
                    "request": {
                        "url": {
                            "protocol": "http",
                            "host": "scim.test",
                            "path": "api\/books",
                            "query": [],
                            "raw": "http:\/\/scim.test\/api\/books"
                        },
                        "method": "POST",
                        "header": [
                            {
                                "key": "Content-Type",
                                "value": "application\/json"
                            },
                            {
                                "key": "Accept",
                                "value": "application\/json"
                            }
                        ],
                        "body": {
                            "mode": "raw",
                            "raw": "[]",
                            "options": {
                                "raw": {
                                    "language": "json"
                                }
                            }
                        },
                        "description": "",
                        "response": []
                    }
                },
                {
                    "name": "api\/books\/{id}",
                    "request": {
                        "url": {
                            "protocol": "http",
                            "host": "scim.test",
                            "path": "api\/books\/:id",
                            "query": [],
                            "raw": "http:\/\/scim.test\/api\/books\/:id"
                        },
                        "method": "GET",
                        "header": [
                            {
                                "key": "Content-Type",
                                "value": "application\/json"
                            },
                            {
                                "key": "Accept",
                                "value": "application\/json"
                            }
                        ],
                        "body": {
                            "mode": "raw",
                            "raw": "[]",
                            "options": {
                                "raw": {
                                    "language": "json"
                                }
                            }
                        },
                        "description": "",
                        "response": []
                    }
                },
                {
                    "name": "api\/books\/{id}",
                    "request": {
                        "url": {
                            "protocol": "http",
                            "host": "scim.test",
                            "path": "api\/books\/:id",
                            "query": [],
                            "raw": "http:\/\/scim.test\/api\/books\/:id"
                        },
                        "method": "POST",
                        "header": [
                            {
                                "key": "Content-Type",
                                "value": "application\/json"
                            },
                            {
                                "key": "Accept",
                                "value": "application\/json"
                            }
                        ],
                        "body": {
                            "mode": "raw",
                            "raw": "[]",
                            "options": {
                                "raw": {
                                    "language": "json"
                                }
                            }
                        },
                        "description": "",
                        "response": []
                    }
                },
                {
                    "name": "api\/books\/{id}",
                    "request": {
                        "url": {
                            "protocol": "http",
                            "host": "scim.test",
                            "path": "api\/books\/:id",
                            "query": [],
                            "raw": "http:\/\/scim.test\/api\/books\/:id"
                        },
                        "method": "DELETE",
                        "header": [
                            {
                                "key": "Content-Type",
                                "value": "application\/json"
                            },
                            {
                                "key": "Accept",
                                "value": "application\/json"
                            }
                        ],
                        "body": {
                            "mode": "raw",
                            "raw": "[]",
                            "options": {
                                "raw": {
                                    "language": "json"
                                }
                            }
                        },
                        "description": "",
                        "response": []
                    }
                },
                {
                    "name": "api\/books\/{id}\/generate-link",
                    "request": {
                        "url": {
                            "protocol": "http",
                            "host": "scim.test",
                            "path": "api\/books\/:id\/generate-link",
                            "query": [],
                            "raw": "http:\/\/scim.test\/api\/books\/:id\/generate-link"
                        },
                        "method": "GET",
                        "header": [
                            {
                                "key": "Content-Type",
                                "value": "application\/json"
                            },
                            {
                                "key": "Accept",
                                "value": "application\/json"
                            }
                        ],
                        "body": {
                            "mode": "raw",
                            "raw": "[]",
                            "options": {
                                "raw": {
                                    "language": "json"
                                }
                            }
                        },
                        "description": "",
                        "response": []
                    }
                },
                {
                    "name": "api\/roles\/permissions",
                    "request": {
                        "url": {
                            "protocol": "http",
                            "host": "scim.test",
                            "path": "api\/roles\/permissions",
                            "query": [],
                            "raw": "http:\/\/scim.test\/api\/roles\/permissions"
                        },
                        "method": "GET",
                        "header": [
                            {
                                "key": "Content-Type",
                                "value": "application\/json"
                            },
                            {
                                "key": "Accept",
                                "value": "application\/json"
                            }
                        ],
                        "body": {
                            "mode": "raw",
                            "raw": "[]",
                            "options": {
                                "raw": {
                                    "language": "json"
                                }
                            }
                        },
                        "description": "",
                        "response": []
                    }
                },
                {
                    "name": "api\/roles",
                    "request": {
                        "url": {
                            "protocol": "http",
                            "host": "scim.test",
                            "path": "api\/roles",
                            "query": [],
                            "raw": "http:\/\/scim.test\/api\/roles"
                        },
                        "method": "GET",
                        "header": [
                            {
                                "key": "Content-Type",
                                "value": "application\/json"
                            },
                            {
                                "key": "Accept",
                                "value": "application\/json"
                            }
                        ],
                        "body": {
                            "mode": "raw",
                            "raw": "[]",
                            "options": {
                                "raw": {
                                    "language": "json"
                                }
                            }
                        },
                        "description": "",
                        "response": []
                    }
                },
                {
                    "name": "api\/roles",
                    "request": {
                        "url": {
                            "protocol": "http",
                            "host": "scim.test",
                            "path": "api\/roles",
                            "query": [],
                            "raw": "http:\/\/scim.test\/api\/roles"
                        },
                        "method": "POST",
                        "header": [
                            {
                                "key": "Content-Type",
                                "value": "application\/json"
                            },
                            {
                                "key": "Accept",
                                "value": "application\/json"
                            }
                        ],
                        "body": {
                            "mode": "raw",
                            "raw": "[]",
                            "options": {
                                "raw": {
                                    "language": "json"
                                }
                            }
                        },
                        "description": "",
                        "response": []
                    }
                },
                {
                    "name": "api\/roles\/{mask}",
                    "request": {
                        "url": {
                            "protocol": "http",
                            "host": "scim.test",
                            "path": "api\/roles\/:mask",
                            "query": [],
                            "raw": "http:\/\/scim.test\/api\/roles\/:mask"
                        },
                        "method": "GET",
                        "header": [
                            {
                                "key": "Content-Type",
                                "value": "application\/json"
                            },
                            {
                                "key": "Accept",
                                "value": "application\/json"
                            }
                        ],
                        "body": {
                            "mode": "raw",
                            "raw": "[]",
                            "options": {
                                "raw": {
                                    "language": "json"
                                }
                            }
                        },
                        "description": "",
                        "response": []
                    }
                },
                {
                    "name": "api\/roles\/{mask}",
                    "request": {
                        "url": {
                            "protocol": "http",
                            "host": "scim.test",
                            "path": "api\/roles\/:mask",
                            "query": [],
                            "raw": "http:\/\/scim.test\/api\/roles\/:mask"
                        },
                        "method": "PUT",
                        "header": [
                            {
                                "key": "Content-Type",
                                "value": "application\/json"
                            },
                            {
                                "key": "Accept",
                                "value": "application\/json"
                            }
                        ],
                        "body": {
                            "mode": "raw",
                            "raw": "[]",
                            "options": {
                                "raw": {
                                    "language": "json"
                                }
                            }
                        },
                        "description": "",
                        "response": []
                    }
                },
                {
                    "name": "api\/roles\/{mask}",
                    "request": {
                        "url": {
                            "protocol": "http",
                            "host": "scim.test",
                            "path": "api\/roles\/:mask",
                            "query": [],
                            "raw": "http:\/\/scim.test\/api\/roles\/:mask"
                        },
                        "method": "DELETE",
                        "header": [
                            {
                                "key": "Content-Type",
                                "value": "application\/json"
                            },
                            {
                                "key": "Accept",
                                "value": "application\/json"
                            }
                        ],
                        "body": {
                            "mode": "raw",
                            "raw": "[]",
                            "options": {
                                "raw": {
                                    "language": "json"
                                }
                            }
                        },
                        "description": "",
                        "response": []
                    }
                },
                {
                    "name": "api\/users",
                    "request": {
                        "url": {
                            "protocol": "http",
                            "host": "scim.test",
                            "path": "api\/users",
                            "query": [],
                            "raw": "http:\/\/scim.test\/api\/users"
                        },
                        "method": "GET",
                        "header": [
                            {
                                "key": "Content-Type",
                                "value": "application\/json"
                            },
                            {
                                "key": "Accept",
                                "value": "application\/json"
                            }
                        ],
                        "body": {
                            "mode": "raw",
                            "raw": "[]",
                            "options": {
                                "raw": {
                                    "language": "json"
                                }
                            }
                        },
                        "description": "",
                        "response": []
                    }
                },
                {
                    "name": "api\/users",
                    "request": {
                        "url": {
                            "protocol": "http",
                            "host": "scim.test",
                            "path": "api\/users",
                            "query": [],
                            "raw": "http:\/\/scim.test\/api\/users"
                        },
                        "method": "POST",
                        "header": [
                            {
                                "key": "Content-Type",
                                "value": "application\/json"
                            },
                            {
                                "key": "Accept",
                                "value": "application\/json"
                            }
                        ],
                        "body": {
                            "mode": "raw",
                            "raw": "[]",
                            "options": {
                                "raw": {
                                    "language": "json"
                                }
                            }
                        },
                        "description": "",
                        "response": []
                    }
                },
                {
                    "name": "api\/users\/{mask}",
                    "request": {
                        "url": {
                            "protocol": "http",
                            "host": "scim.test",
                            "path": "api\/users\/:mask",
                            "query": [],
                            "raw": "http:\/\/scim.test\/api\/users\/:mask"
                        },
                        "method": "GET",
                        "header": [
                            {
                                "key": "Content-Type",
                                "value": "application\/json"
                            },
                            {
                                "key": "Accept",
                                "value": "application\/json"
                            }
                        ],
                        "body": {
                            "mode": "raw",
                            "raw": "[]",
                            "options": {
                                "raw": {
                                    "language": "json"
                                }
                            }
                        },
                        "description": "",
                        "response": []
                    }
                },
                {
                    "name": "api\/users\/{mask}",
                    "request": {
                        "url": {
                            "protocol": "http",
                            "host": "scim.test",
                            "path": "api\/users\/:mask",
                            "query": [],
                            "raw": "http:\/\/scim.test\/api\/users\/:mask"
                        },
                        "method": "PUT",
                        "header": [
                            {
                                "key": "Content-Type",
                                "value": "application\/json"
                            },
                            {
                                "key": "Accept",
                                "value": "application\/json"
                            }
                        ],
                        "body": {
                            "mode": "raw",
                            "raw": "[]",
                            "options": {
                                "raw": {
                                    "language": "json"
                                }
                            }
                        },
                        "description": "",
                        "response": []
                    }
                },
                {
                    "name": "api\/users\/{mask}",
                    "request": {
                        "url": {
                            "protocol": "http",
                            "host": "scim.test",
                            "path": "api\/users\/:mask",
                            "query": [],
                            "raw": "http:\/\/scim.test\/api\/users\/:mask"
                        },
                        "method": "DELETE",
                        "header": [
                            {
                                "key": "Content-Type",
                                "value": "application\/json"
                            },
                            {
                                "key": "Accept",
                                "value": "application\/json"
                            }
                        ],
                        "body": {
                            "mode": "raw",
                            "raw": "[]",
                            "options": {
                                "raw": {
                                    "language": "json"
                                }
                            }
                        },
                        "description": "",
                        "response": []
                    }
                },
                {
                    "name": "api\/groups",
                    "request": {
                        "url": {
                            "protocol": "http",
                            "host": "scim.test",
                            "path": "api\/groups",
                            "query": [],
                            "raw": "http:\/\/scim.test\/api\/groups"
                        },
                        "method": "GET",
                        "header": [
                            {
                                "key": "Content-Type",
                                "value": "application\/json"
                            },
                            {
                                "key": "Accept",
                                "value": "application\/json"
                            }
                        ],
                        "body": {
                            "mode": "raw",
                            "raw": "[]",
                            "options": {
                                "raw": {
                                    "language": "json"
                                }
                            }
                        },
                        "description": "",
                        "response": []
                    }
                },
                {
                    "name": "api\/groups",
                    "request": {
                        "url": {
                            "protocol": "http",
                            "host": "scim.test",
                            "path": "api\/groups",
                            "query": [],
                            "raw": "http:\/\/scim.test\/api\/groups"
                        },
                        "method": "POST",
                        "header": [
                            {
                                "key": "Content-Type",
                                "value": "application\/json"
                            },
                            {
                                "key": "Accept",
                                "value": "application\/json"
                            }
                        ],
                        "body": {
                            "mode": "raw",
                            "raw": "[]",
                            "options": {
                                "raw": {
                                    "language": "json"
                                }
                            }
                        },
                        "description": "",
                        "response": []
                    }
                },
                {
                    "name": "api\/groups\/{mask}",
                    "request": {
                        "url": {
                            "protocol": "http",
                            "host": "scim.test",
                            "path": "api\/groups\/:mask",
                            "query": [],
                            "raw": "http:\/\/scim.test\/api\/groups\/:mask"
                        },
                        "method": "GET",
                        "header": [
                            {
                                "key": "Content-Type",
                                "value": "application\/json"
                            },
                            {
                                "key": "Accept",
                                "value": "application\/json"
                            }
                        ],
                        "body": {
                            "mode": "raw",
                            "raw": "[]",
                            "options": {
                                "raw": {
                                    "language": "json"
                                }
                            }
                        },
                        "description": "",
                        "response": []
                    }
                },
                {
                    "name": "api\/groups\/{mask}",
                    "request": {
                        "url": {
                            "protocol": "http",
                            "host": "scim.test",
                            "path": "api\/groups\/:mask",
                            "query": [],
                            "raw": "http:\/\/scim.test\/api\/groups\/:mask"
                        },
                        "method": "PUT",
                        "header": [
                            {
                                "key": "Content-Type",
                                "value": "application\/json"
                            },
                            {
                                "key": "Accept",
                                "value": "application\/json"
                            }
                        ],
                        "body": {
                            "mode": "raw",
                            "raw": "[]",
                            "options": {
                                "raw": {
                                    "language": "json"
                                }
                            }
                        },
                        "description": "",
                        "response": []
                    }
                },
                {
                    "name": "api\/groups\/{mask}",
                    "request": {
                        "url": {
                            "protocol": "http",
                            "host": "scim.test",
                            "path": "api\/groups\/:mask",
                            "query": [],
                            "raw": "http:\/\/scim.test\/api\/groups\/:mask"
                        },
                        "method": "DELETE",
                        "header": [
                            {
                                "key": "Content-Type",
                                "value": "application\/json"
                            },
                            {
                                "key": "Accept",
                                "value": "application\/json"
                            }
                        ],
                        "body": {
                            "mode": "raw",
                            "raw": "[]",
                            "options": {
                                "raw": {
                                    "language": "json"
                                }
                            }
                        },
                        "description": "",
                        "response": []
                    }
                },
                {
                    "name": "\/",
                    "request": {
                        "url": {
                            "protocol": "http",
                            "host": "scim.test",
                            "path": "\/",
                            "query": [],
                            "raw": "http:\/\/scim.test\/\/"
                        },
                        "method": "GET",
                        "header": [
                            {
                                "key": "Content-Type",
                                "value": "application\/json"
                            },
                            {
                                "key": "Accept",
                                "value": "application\/json"
                            }
                        ],
                        "body": {
                            "mode": "raw",
                            "raw": "[]",
                            "options": {
                                "raw": {
                                    "language": "json"
                                }
                            }
                        },
                        "description": "",
                        "response": []
                    }
                },
                {
                    "name": "books\/{token}\/download",
                    "request": {
                        "url": {
                            "protocol": "http",
                            "host": "scim.test",
                            "path": "books\/:token\/download",
                            "query": [],
                            "raw": "http:\/\/scim.test\/books\/:token\/download"
                        },
                        "method": "GET",
                        "header": [
                            {
                                "key": "Content-Type",
                                "value": "application\/json"
                            },
                            {
                                "key": "Accept",
                                "value": "application\/json"
                            }
                        ],
                        "body": {
                            "mode": "raw",
                            "raw": "[]",
                            "options": {
                                "raw": {
                                    "language": "json"
                                }
                            }
                        },
                        "description": "",
                        "response": []
                    }
                }
            ]
        }
    ]
}
```

### Request
<small class="badge badge-green">GET</small>
 **`docs.json`**



## Authorize a client to access the user&#039;s account.




> Example request:

```bash
curl -X GET \
    -G "http://scim.test/oauth/authorize" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://scim.test/oauth/authorize"
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
 **`oauth/authorize`**



## Approve the authorization request.




> Example request:

```bash
curl -X POST \
    "http://scim.test/oauth/authorize" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://scim.test/oauth/authorize"
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
 **`oauth/authorize`**



## Deny the authorization request.




> Example request:

```bash
curl -X DELETE \
    "http://scim.test/oauth/authorize" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://scim.test/oauth/authorize"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### Request
<small class="badge badge-red">DELETE</small>
 **`oauth/authorize`**



## Authorize a client to access the user&#039;s account.




> Example request:

```bash
curl -X POST \
    "http://scim.test/oauth/token" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://scim.test/oauth/token"
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
 **`oauth/token`**



## Get all of the authorized tokens for the authenticated user.




> Example request:

```bash
curl -X GET \
    -G "http://scim.test/oauth/tokens" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://scim.test/oauth/tokens"
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
 **`oauth/tokens`**



## Delete the given token.




> Example request:

```bash
curl -X DELETE \
    "http://scim.test/oauth/tokens/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://scim.test/oauth/tokens/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### Request
<small class="badge badge-red">DELETE</small>
 **`oauth/tokens/{token_id}`**



## Get a fresh transient token cookie for the authenticated user.




> Example request:

```bash
curl -X POST \
    "http://scim.test/oauth/token/refresh" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://scim.test/oauth/token/refresh"
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
 **`oauth/token/refresh`**



## Get all of the clients for the authenticated user.




> Example request:

```bash
curl -X GET \
    -G "http://scim.test/oauth/clients" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://scim.test/oauth/clients"
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
 **`oauth/clients`**



## Store a new client.




> Example request:

```bash
curl -X POST \
    "http://scim.test/oauth/clients" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://scim.test/oauth/clients"
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
 **`oauth/clients`**



## Update the given client.




> Example request:

```bash
curl -X PUT \
    "http://scim.test/oauth/clients/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://scim.test/oauth/clients/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### Request
<small class="badge badge-darkblue">PUT</small>
 **`oauth/clients/{client_id}`**



## Delete the given client.




> Example request:

```bash
curl -X DELETE \
    "http://scim.test/oauth/clients/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://scim.test/oauth/clients/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### Request
<small class="badge badge-red">DELETE</small>
 **`oauth/clients/{client_id}`**



## Get all of the available scopes for the application.




> Example request:

```bash
curl -X GET \
    -G "http://scim.test/oauth/scopes" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://scim.test/oauth/scopes"
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
 **`oauth/scopes`**



## Get all of the personal access tokens for the authenticated user.




> Example request:

```bash
curl -X GET \
    -G "http://scim.test/oauth/personal-access-tokens" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://scim.test/oauth/personal-access-tokens"
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
 **`oauth/personal-access-tokens`**



## Create a new personal access token for the user.




> Example request:

```bash
curl -X POST \
    "http://scim.test/oauth/personal-access-tokens" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://scim.test/oauth/personal-access-tokens"
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
 **`oauth/personal-access-tokens`**



## Delete the given token.




> Example request:

```bash
curl -X DELETE \
    "http://scim.test/oauth/personal-access-tokens/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://scim.test/oauth/personal-access-tokens/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### Request
<small class="badge badge-red">DELETE</small>
 **`oauth/personal-access-tokens/{token_id}`**



## api/public/books




> Example request:

```bash
curl -X GET \
    -G "http://scim.test/api/public/books" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://scim.test/api/public/books"
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


> Example response (200):

```json
{
    "code": 200,
    "status": "success",
    "data": []
}
```

### Request
<small class="badge badge-green">GET</small>
 **`api/public/books`**



## api/books




> Example request:

```bash
curl -X GET \
    -G "http://scim.test/api/books" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://scim.test/api/books"
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
 **`api/books`**



## api/books




> Example request:

```bash
curl -X POST \
    "http://scim.test/api/books" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://scim.test/api/books"
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
 **`api/books`**



## api/books/{id}




> Example request:

```bash
curl -X GET \
    -G "http://scim.test/api/books/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://scim.test/api/books/1"
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
 **`api/books/{id}`**



## api/books/{id}




> Example request:

```bash
curl -X POST \
    "http://scim.test/api/books/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://scim.test/api/books/1"
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
 **`api/books/{id}`**



## api/books/{id}




> Example request:

```bash
curl -X DELETE \
    "http://scim.test/api/books/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://scim.test/api/books/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### Request
<small class="badge badge-red">DELETE</small>
 **`api/books/{id}`**



## api/books/{id}/generate-link




> Example request:

```bash
curl -X GET \
    -G "http://scim.test/api/books/1/generate-link" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://scim.test/api/books/1/generate-link"
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
 **`api/books/{id}/generate-link`**



## api/roles/permissions




> Example request:

```bash
curl -X GET \
    -G "http://scim.test/api/roles/permissions" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://scim.test/api/roles/permissions"
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
 **`api/roles/permissions`**



## api/roles




> Example request:

```bash
curl -X GET \
    -G "http://scim.test/api/roles" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://scim.test/api/roles"
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
 **`api/roles`**



## api/roles




> Example request:

```bash
curl -X POST \
    "http://scim.test/api/roles" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://scim.test/api/roles"
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
 **`api/roles`**



## api/roles/{mask}




> Example request:

```bash
curl -X GET \
    -G "http://scim.test/api/roles/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://scim.test/api/roles/1"
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
 **`api/roles/{mask}`**



## api/roles/{mask}




> Example request:

```bash
curl -X PUT \
    "http://scim.test/api/roles/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://scim.test/api/roles/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### Request
<small class="badge badge-darkblue">PUT</small>
 **`api/roles/{mask}`**



## api/roles/{mask}




> Example request:

```bash
curl -X DELETE \
    "http://scim.test/api/roles/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://scim.test/api/roles/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### Request
<small class="badge badge-red">DELETE</small>
 **`api/roles/{mask}`**



## api/users




> Example request:

```bash
curl -X GET \
    -G "http://scim.test/api/users" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://scim.test/api/users"
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
 **`api/users`**



## api/users




> Example request:

```bash
curl -X POST \
    "http://scim.test/api/users" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://scim.test/api/users"
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
 **`api/users`**



## api/users/{mask}




> Example request:

```bash
curl -X GET \
    -G "http://scim.test/api/users/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://scim.test/api/users/1"
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
 **`api/users/{mask}`**



## api/users/{mask}




> Example request:

```bash
curl -X PUT \
    "http://scim.test/api/users/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://scim.test/api/users/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### Request
<small class="badge badge-darkblue">PUT</small>
 **`api/users/{mask}`**



## api/users/{mask}




> Example request:

```bash
curl -X DELETE \
    "http://scim.test/api/users/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://scim.test/api/users/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### Request
<small class="badge badge-red">DELETE</small>
 **`api/users/{mask}`**



## api/groups




> Example request:

```bash
curl -X GET \
    -G "http://scim.test/api/groups" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://scim.test/api/groups"
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
 **`api/groups`**



## api/groups




> Example request:

```bash
curl -X POST \
    "http://scim.test/api/groups" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://scim.test/api/groups"
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
 **`api/groups`**



## api/groups/{mask}




> Example request:

```bash
curl -X GET \
    -G "http://scim.test/api/groups/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://scim.test/api/groups/1"
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
 **`api/groups/{mask}`**



## api/groups/{mask}




> Example request:

```bash
curl -X PUT \
    "http://scim.test/api/groups/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://scim.test/api/groups/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### Request
<small class="badge badge-darkblue">PUT</small>
 **`api/groups/{mask}`**



## api/groups/{mask}




> Example request:

```bash
curl -X DELETE \
    "http://scim.test/api/groups/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://scim.test/api/groups/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### Request
<small class="badge badge-red">DELETE</small>
 **`api/groups/{mask}`**



## api/people




> Example request:

```bash
curl -X GET \
    -G "http://scim.test/api/people" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://scim.test/api/people"
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
 **`api/people`**



## api/people




> Example request:

```bash
curl -X POST \
    "http://scim.test/api/people" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://scim.test/api/people"
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
 **`api/people`**



## api/people/{mask}




> Example request:

```bash
curl -X GET \
    -G "http://scim.test/api/people/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://scim.test/api/people/1"
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
 **`api/people/{mask}`**



## /




> Example request:

```bash
curl -X GET \
    -G "http://scim.test/" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://scim.test/"
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


> Example response (200):

```json

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            
            <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>

                <div class="links">
                    <a href="https://laravel.com/docs">Docs</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://blog.laravel.com">Blog</a>
                    <a href="https://nova.laravel.com">Nova</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://vapor.laravel.com">Vapor</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div>
            </div>
        </div>
    </body>
</html>

```

### Request
<small class="badge badge-green">GET</small>
 **`/`**



## books/{token}/download




> Example request:

```bash
curl -X GET \
    -G "http://scim.test/books/1/download" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://scim.test/books/1/download"
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


> Example response (400):

```json
{
    "code": 400,
    "status": "error",
    "data": null,
    "message": "Trying to get property 'book_id' of non-object"
}
```

### Request
<small class="badge badge-green">GET</small>
 **`books/{token}/download`**




