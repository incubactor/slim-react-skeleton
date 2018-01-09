<?php
require __DIR__ . '/../vendor/autoload.php';
$settings = require __DIR__ . '/../app/config/settings.php';
$settings += array(
    'version'        => '0.0.0',
    'debug'          => false,
    'mode'           => 'testing',
    'templates.path' => __DIR__ . '/../app/templates'
);

$di = new SlimAura\Container($settings);
$app = new \Slim\App($di);
require __DIR__ . '/../app/config/dependencies.php';
require __DIR__ . '/../app/config/middleware.php';
require __DIR__ . '/../app/config/routes.php';
$app->run();
