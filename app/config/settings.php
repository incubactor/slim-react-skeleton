<?php
return [

    'displayErrorDetails' => true, // set to false in production

    'addContentLengthHeader' => false, // Allow the web server to send the content-length header

    'view' => [
        'layoutPath' => __DIR__ . '/../../src/layout/',
    ],

    'logger' => [
        'name' => 'slim-app',
        'path' => __DIR__ . '/../log/app.log',
    ],

    'pdo' => [
        'dns'      => 'mysql:dbname=sampledb;host=127.0.0.1;charset=utf8',
        'user'     => 'root',
        'password' => '123456'
    ],

    'auth' => [
        'jwtKey' => '1234567890ABCDEF',
        'requestAttribute' => 'jwt',
        'relaxed' => ["localhost", "127.0.0.1", "localhost:8888",] ,
        'path' => [ "/items"],
        'passthrough' => ["/", "/auth", "/api/v1/auth"],
    ],
    'routes' => [
        'path' => __DIR__ . '/interface.json',     
    ]

];
