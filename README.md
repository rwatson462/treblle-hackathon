# treblle-hackathon
Treblle security hackathon code

### Installation
Check out the repository and run in a Laravel environment of some sort.
After checking out the repository, running the below commands should get you going:
1. `composer install`
2. `php artisan key:generate`
3. `php artisan migrate`
4. `php artisan serve`

The code is also running at https://hackathon.source-pot.dev.

### Tests
A phpunit test suite is included, just run `php artisan test` and watch the magic.

### Endpoints

#### Register a new user: `POST /v1/auth/register`
with JSON payload:
```json
{
  "email": <string>
  "name": <string>
  "password": <string>
}
```

Success response:
```json
{
  "message": "success",
  "user_id": <uuid>
}
```

Error response (deliberately vague to not give away knowledge of existing email addresses in use):
```json
{
  "message": "error registering user"
}
```

---
#### Log in: `POST /v1/auth/login`
with JSON payload:
```json
{
  "email": <string>
  "password": <string>
}
```

Success response:
```json
{
    "message": "success",
    "token": <bearer token>,
    "expires": <date of token expiration>
}
```

Error response (deliberately not revealing which of email or password is incorrect):
```json
{
    "message": "invalid email\/password combination"
}
```


---
#### User profile: `GET /v1/auth/me`
Requires bearer token obtained from Login endpoint.  

Success response:
```json
{
	"id": <uuid>,
	"name": <name>,
	"email": <email>
}
```

The only error response for this endpoint is an unauthenticated response.


---
#### Logout: `POST v1/auth/logout`
Requires a bearer token obtained from the login endpoint.

Success response:
```json
{
    "message": "logged out"
}
```

The only error response returned is if the user fails to authenticate with the bearer token.


---
#### Create a model: `POST v1/model`
Requires bearer authentication.

with JSON payload:
```json
{
  "name": <string>,
  "attributes": {
    "attribute_name": <string>
  }
}
```

The input accepted here is a name for the model (think of a database table name).  
The attributes list describes the data the model can contain (think of database columns).
The key for each attribute is its name, the value should be a string that Laravel understands
to validate input with (e.g. "required|string|max:255").


Success response:
```json
{
    "message": "created",
    "model_id": <uuid>
}
```

Error response (beyond scope of this exercise for individualised responses):
```json
{
    "message": "invalid parameters given"
}
```


---
#### List all models: `GET v1/model`
Lists all models created by the authenticated user.
Requires bearer authentication.

Success response:
```json
{
	"models": [
        {
            "name": <model name>,
            "id": <model uuid>
        }
    ]
}
```
---
#### List model instances: `GET /v1/model/{model_uuid}`
Lists all model instances for the given model.
Requires bearer authentication.

Success response:
```json
{
	"models": [
        {
            "id": <string>,
            ...attributes
        }
    ]
}
```

Error response:
404 if the model id does not link to a model that the user created (or that does not exist)
#### Create a model instance: `POST /v1/model/{model_uuid}`
Requires bearer authentication.

With JSON payload:
```json
{
    ...attributes given when creating the model
}
```

Success response:
```json
{
    "message": "created",
    "instance_id": <uuid>
}
```

Error response (if validation fails, again deliberately vague):
```json
{
	"message": "invalid parameters given"
}
```

Error response (if trying to create an instance on someone else's model):  
I ran out of time to make this fancy.
```json
{
	"message": "This action is unauthorized."
}
```

### Security notes

I've removed many parts of Laravel that are not related to the API - views, package.json, css/js files, etc.  
Robots.txt has been updated to (hopefully) tell any crawlers to leave the site alone.  

While Laravel supports Secure Connections, the upgrading of those requests should be handled by the server software (Nginx, for example).
I have added some middleware that will deny access to any endpoints if accessed through `http` (as opposed to `https`), but only for the Production environment.
See `App\Http\Middleware\DenyInsecureRequestsInProduction`.


### Examples

Here are some examples to use the application:
Register:
`POST /v1/auth/register`
```json
{
    "name": "User",
    "email": "user@example.com",
    "password": "password"
}
```

Login:
`POST /v1/auth/login`
```json
{
    "email": "user@example.com",
    "password": "password"
}
```
Note token returned

Create a model:
`POST /v1/model`
```json
{
    "name": "people",
    "attributes": {
      "name": "required|string|max:255",
      "position": "required|in:director,manager,team_member"
    }
}
```
Note model ID returned

Create a model instance:
`POST /v1/model/{model_id}`  
The data posted here must match the "attributes" array given when creating the model
```json
{
    "name": "Rob",
    "position": "director"
}
```

List all instances for the model:
`GET /v1/model/{model_id}`
See the model you created a minute ago :)
