# SunMoonTec API Spec

## Running API tests locally

To locally run the provided Postman collection against your backend, execute:

```
APIURL=http://127.0.0.1:8000/api
```


### Authentication Header:

`Authorization: Bearer Token token.here`

## JSON Objects returned by API:

Make sure the right content type like `Content-Type: application/json; charset=utf-8` is correctly returned.

### Registraiton

```JSON
{
    "message": "Signup successful!",
    "data": {
        "id": 23,
        "email": "alan2@test.com22",
        "name": "dasdsadsas"
    },
    "status": 200
}
```

### Authentication

```JSON
{
    "message": "Login successful!",
    "data": {
        "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiMGE2NjM1NDU0ZjVlMGNiMWQ0YzMxZDJiZDQ1OGFmNDBlYTVmZTgxMmJjOGExYjYzM2I5MmJkZTVhMWZmMGM5OGNmM2RmY2FmOWZkZTc2MDYiLCJpYXQiOjE2MzYxMTY3MDYsIm5iZiI6MTYzNjExNjcwNiwiZXhwIjoxNjY3NjUyNzA2LCJzdWIiOiIxNiIsInNjb3BlcyI6W119.fhamEWI2T3JNpFQOzfjzmOiFOgD2CvKZHuXgkQafhGKvX8wchVqII6Udxy41v0s-6pF-E50cY__itOkUcbYSiJLo4Ark3_H2Vz82Knnn5UhnsaXXD1dl3d4dqhFBJ0GA-5BqEGgB5tIszCKCedYwlB50R6c1EHBehdxt8KFWCnCzTnBrVzOODblKBQWjOiGjoLeJUHOgzY-rJLga2cw45kRUSWw9bZI-T_ELenvACIwzgJ0rnek3C5DSKMVSBliaNX1axH-Yh4Axv-U-tTaS8LvaLYGyaUJGbTTFFH9NOW0DrdE_EkE4JkQPR6sPg421s4z-2nuR3L7S5xm09tMTztkboS30Uxthm_uJlWOYvfY7xqfhpZ1GXovGpfu9SMZ3WNNT9bwBkMN0NEoOaSYK1Qreg8-YJKpUMckcSSDm0Rse9HH3GMDmK5EX9yegXz9MxR748LqW-7QOT8HQ8FsGFxL29u8fGoy21l3dqlu3FIgWi0bpGUaEZtbmILVJO8qM81_tm22DYcr8QgmI30ftgYopSGoY-syShv-HnB1GpfOnloUdTgevPySZP8NPT9Cjxez50rseuCL_6QhMYlwu3I6LNlAKZmnBfYL5-RZ-DAWBqtH7tABNdpdC_pJeBtM4dmAAMdEbQva4hL3UbkAyrC4yaCjpcz4XKEmRCkVukDk"
    },
    "status": 200
}
```

### Public (Get Posts)

```JSON
{
    "message": "Success!",
    "data": [
        [
            {
                "id": 15,
                "title": "Test Post",
                "content": "Test Conetne",
                "author": "sunmoontech"
            },
            {
                "id": 16,
                "title": "Test Post",
                "content": "Test Conetne",
                "author": "sunmoontech"
            },
            {
                "id": 17,
                "title": "Test Post",
                "content": "Test Conetne",
                "author": "sunmoontech"
            },
            {
                "id": 19,
                "title": "Test Postdsad",
                "content": "Test Conetnedsadsa",
                "author": "sunmoontech"
            },
            {
                "id": 21,
                "title": "Test Title 123456",
                "content": "Test Content 1234",
                "author": "sunmoontech"
            },
            {
                "id": 22,
                "title": "New Post",
                "content": "New Post Content",
                "author": "sunmoontech"
            },
            {
                "id": 23,
                "title": "New Post 1",
                "content": "New Post Content 1",
                "author": "sunmoontech"
            },
            {
                "id": 24,
                "title": "New Post 11",
                "content": "New Post Content 11",
                "author": "sunmoontech"
            },
            {
                "id": 25,
                "title": "dsadsadsa123",
                "content": "3213213",
                "author": "sunmoontech"
            }
        ]
    ],
    "status": 200
}
```

### Public (Get Post By id)

```JSON
{
    "message": "Success!",
    "data": {
        "id": 25,
        "title": "dsadsadsa123",
        "content": "3213213",
        "author": "sunmoontech"
    },
    "status": 200
}
```

### Public (Get Comments)

```JSON
{
    "message": "Success!",
    "data": [
        [
            {
                "id": 30,
                "post_id": 25,
                "comment": "New Comment",
                "author": "sunmoontech"
            },
            {
                "id": 31,
                "post_id": 25,
                "comment": "New Comment",
                "author": "sunmoontech"
            },
            {
                "id": 32,
                "post_id": 25,
                "comment": "dsadsadsa123",
                "author": "sunmoontech"
            }
        ]
    ],
    "status": 200
}
```

### Public (Get Comments By Id)

```JSON
{
    "message": "Success!",
    "data": {
        "id": 32,
        "post_id": 25,
        "comment": "dsadsadsa123",
        "author": "sunmoontech"
    },
    "status": 200
}
```

### Needs Auth (Create Post)

```JSON
{
    "message": "Record successfully added!",
    "data": {
        "title": "New Post 1111",
        "content": "New Post Content 1111",
        "id": 26,
        "author": "sunmoontech"
    },
    "status": 200
}
```

### Needs Auth (Update Post)

```JSON
{
    "message": "Record successfully updated!",
    "data": {
        "id": "26",
        "title": "dsadsadsa12312",
        "content": "3213213",
        "author": "sunmoontech"
    },
    "status": 200
}
```

### Needs Auth (Delete Post)

```JSON
{
    "message": "Record successfully deleted!",
    "data": {
        "id": 22,
        "title": "New Post",
        "content": "New Post Content",
        "author": "sunmoontech"
    },
    "status": 200
}
```

### Needs Auth (Delete Post)

```JSON
{
    "message": "Success!",
    "data": [
        [
            {
                "id": 15,
                "title": "Test Post",
                "content": "Test Conetne",
                "author": "sunmoontech"
            },
            {
                "id": 16,
                "title": "Test Post",
                "content": "Test Conetne",
                "author": "sunmoontech"
            },
            {
                "id": 17,
                "title": "Test Post",
                "content": "Test Conetne",
                "author": "sunmoontech"
            },
            {
                "id": 19,
                "title": "Test Postdsad",
                "content": "Test Conetnedsadsa",
                "author": "sunmoontech"
            },
            {
                "id": 21,
                "title": "Test Title 123456",
                "content": "Test Content 1234",
                "author": "sunmoontech"
            },
            {
                "id": 23,
                "title": "New Post 1",
                "content": "New Post Content 1",
                "author": "sunmoontech"
            },
            {
                "id": 24,
                "title": "New Post 11",
                "content": "New Post Content 11",
                "author": "sunmoontech"
            },
            {
                "id": 25,
                "title": "dsadsadsa123",
                "content": "3213213",
                "author": "sunmoontech"
            },
            {
                "id": 26,
                "title": "dsadsadsa12312",
                "content": "3213213",
                "author": "sunmoontech"
            }
        ]
    ],
    "status": 200
}
```

### Needs Auth (Create Comment)

```JSON
{
    "message": "Record successfully added!",
    "data": {
        "comment": "New Comment",
        "post_id": 26,
        "id": 33,
        "author": "sunmoontech"
    },
    "status": 200
}
```

### Needs Auth (Update Comment)

```JSON
{
    "message": "Record successfully updated!",
    "data": {
        "id": "33",
        "title": "dsadsadsa123",
        "author": "sunmoontech"
    },
    "status": 200
}
```

### Needs Auth (Delete Comment)

```JSON
{
    "message": "Record successfully deleted!",
    "data": {
        "id": 31,
        "post_id": 25,
        "comment": "New Comment",
        "author": "sunmoontech"
    },
    "status": 200
}
```
### Needs Auth (My Comments)

```JSON
{
    "message": "Success!",
    "data": [
        [
            {
                "id": 33,
                "post_id": 26,
                "comment": "dsadsadsa123",
                "author": "sunmoontech"
            }
        ]
    ],
    "status": 200
}
```

### Errors and Status Codes

If a request fails any validations, expect a 422 and errors in the following format:

```JSON
{"status":404,"error":"The requested resource was not found"}
```

#### Other status codes:

401 for Unauthorized requests, when a request requires authentication but it isn't provided

403 for Forbidden requests, when a request may be valid but the user doesn't have permissions to perform the action

404 for Not found requests, when a resource can't be found to fulfill the request

Other validation Errors

## Endpoints:

### 1. User Signup
    HTTP Method: POST
    URL: /auth/signup

#### Request Body
    email - user’s email (required|email|unique:users)
    password - user’s password (required|min:8)
    name - user’s name (required|min:4|unique:users)

### 2. User Login
    HTTP Method: POST
    URL: /auth/login
    Headers: - Authorization: "Basic {encodedusername:password}"

####  Request Body
    email - user’s email (required|email|exists:users)
    password - user’s password (required|min:8)

### 3. Create Post
    HTTP Method: POST
    URL: /posts
    Headers: - Authorization: "Bearer {token}"

#### Request Body
    title - blog title (required|unique:posts)
    content - blog content (required)

### 4. Update Post
    HTTP Method: PUT
    URL: /posts/:id
    Headers: - Authorization: "Bearer {token}"

#### Request Body
    title - blog title (required|unique:posts)
    content - blog content 

**Arguments**

    :id - post id (required|integer|exists:posts)

### 5. Delete Post
    Note: Only post author should be able to do this operation.
    HTTP Method: DELETE
    URL: /posts/:id
    Headers: - Authorization: "Bearer {token}"

**Arguments**

    :id - post id (required|integer|exists:posts)

### 6. Retrieve Logged-in User’s Posts
    Fetches all posts created by logged-in user.
    HTTP Method: GET
    URL: /me/posts
    Headers: - Authorization: "Bearer {token}"

#### Optional Request Body
    limit - no. of records (required|integer)
    offset - page no. (required|integer)

###  7. Retrieve All Posts
    Fetches all posts. This endpoint should be publicly accessible.
    HTTP Method: GET
    URL: /posts

#### Optional Request Body
    limit - no. of records (required|integer)
    offset - page no. (required|integer)


### 8. Retrieve Single Post
    This endpoint should be publicly accessible.
    HTTP Method: GET
    URL: /posts/:id

**Arguments**

    :id - post id ('required|integer|exists:posts')

### 9. Create Comment
    HTTP Method: POST
    URL: /posts/:post_id/comments
    Headers: - Authorization: "Bearer {token}"

#### Request Body
    comment - comment content (required)

**Arguments**

    :post_id - post id (required|integer|exists:posts,id)

### 10. Delete Comment
    Note: Only post author AND comment author should be able to do this operation.
    HTTP Method: DELETE
    URL: /posts/:post_id/comments/:id
    Headers: - Authorization: "Bearer {token}"

**Arguments**

    :post_id - post id (required|integer|exists:posts,id)
    :id - comment id (required|exists:comments)

### 11. Retrieve Post Comments
    This endpoint should be publicly accessible.
    HTTP Method: GET
    URL: /posts/:post_id/comments

#### Optional Request Body
    limit - no. of records (required|integer)
    offset - page no. (required|integer)

**Arguments**

    :post_id - post id (required|integer|exists:posts,id)
    :id - comment id (required|exists:comments)
