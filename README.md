# Author Service API
A RESTful API application built with [Lumen - PHP Micro-framework by Laravel](https://lumen.laravel.com/).
The goal of this application is to perform CRUD actions through some endpoints.


## 🎯 Goals
1. Implement CRUD operations with respective HTTP methods.
    - [Route](#TODO)
    - [Model](#TODO)
2. Consistent and uniform of response structure (JSON schema).
    - [API Respone trait](#TODO)
3. Handling particular exceptions and errors for the whole app.
    - [Exceptions handler](#TODO)
4. Basic implementation of Laravel migrations, factories, and seeders.
    - [Migration](#TODO)
    - [Factory](#TODO)
    - [Seeder](#TODO)


## 🏗️ Development Environment
**Tools and versions:**
```
Lumen: ^8.0
Composer: 2.1.3
PHP: ^7.4.16
```

**Database Provider:**
- sqlite3

**Additional Tools:**
- [OSSP `uuid`](http://www.ossp.org/pkg/lib/uuid/): Used to generate `APP_KEY` env variable manually.


## 🚏 Endpoints
| Method | Endpoint              | Status | Description                              |
| ------ | --------------------- | ------ | ---------------------------------------- |
| GET    | `/authors`            | 200    | Retrieve list of authors                 |
| GET    | `/authors/{authorId}` | 200    | Retrieve one of author data              |
|        |                       |        |                                          |
| POST   | `/authors`            | 201    | Create and store new author data into DB |
|        |                       |        |                                          |
| PUT    | `/authors/{authorId}` | 200    | Update existing author data              |
| PATCH  | `/authors/{authorId}` | 200    | Update existing author data              |
|        |                       |        |                                          |
| DELETE | `/authors/{authorId}` | 200    | Delete specific author from the DB       |

**Additional information:**

- `POST` method should use `Content-Type: multipart/form-data` for its HTTP request header field.
- `PUT` and `PATCH` method should use `Content-Type: application/x-www-form-urlencoded` for its HTTP request header field.
- Some endpoints will be returning an error (either internal or client), please keep in mind for the status code could change respectively to the error.
