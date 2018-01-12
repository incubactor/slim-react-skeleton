# Slim Framework 3 Skeleton Application + ReactJs + OpenApi

This skeleton is a fork and contain ideas from those repos:

* [https://github.com/geraudi/slim-react-skeleton](https://github.com/geraudi/slim-react-skeleton)
* [https://github.com/shameerc/slim-skeleton](https://github.com/shameerc/slim-skeleton)
* [https://github.com/akrabat/slim3-skeleton](https://github.com/akrabat/slim3-skeleton)


## Api upfront Design

The whole application interface is described in this [OpenAPI document](https://app.swaggerhub.com/apis/virgiliolino/slim-react-skeleton/1.0.0). There is no manual routes coding. Just a Json or Yaml file that describes how either frontend and the API should behave. The componend [Swagger-Dispatcher](https://packagist.org/packages/dispatcher/swagger-dispatcher) will take care of automatically building all the routes needed. Of course, because of dependency injection, you'll have to inject all the Command Handlers.

## Install

### Slim 3
```
composer install
```

### Webpack + ReactJs + Karma

Installation :

```
npm install
```

Run webpack dev server :

```
npm run start

```

Run test :

```
vendor/bin/phpunit tests
```

##Config

###app/config/settings.php

#### Database
Please create a DB. In order to test our application, import the [sql file](https://github.com/incubactor/slim-react-skeleton/blob/master/db.sql)
The add the parameters of the db to app/config/settings.php
```
...
'pdo' => [
        'dns'      => 'mysql:dbname=my-db;host=127.0.0.1;charset=utf8',
        'user'     => 'root',
        'password' => 'root'
    ],
 ...
```

#### JWT

```
...
'auth' => [
        'jwtKey' => '1234567890ABCDEF', // <= Change here
        'requestAttribute' => 'jwt',
        'relaxed' => ["localhost", "127.0.0.1", "sampleapp.local",] ,
        'path' => [ "/items"],
        'passthrough' => ["/", "/auth", "/api/v1/auth"],
]
 ...

```

* By default, we request a secure connection, during development you'll have to add your
url to the **relaxed** key.
* All the routes that require the user to be authenticated, must be added to **path**
* All the routes that may be called without a secure token(generated after authentication), must be added to **passthrough**

### React Call API

####src/js/lib/api.js

```
...
axios.defaults.baseURL = 'http://example.com/api/v1/';
...
```


    

