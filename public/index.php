<?php
require __DIR__ . '/../vendor/autoload.php';

$settings = require __DIR__ . '/../app/config/settings.php';
$di = new SlimAura\Container($settings);
$app = new \Slim\App($di);
require __DIR__ . '/../app/config/dependencies.php';
require __DIR__ . '/../app/config/middleware.php';

$swaggerFile = $di->get('settings')['routes']['path'];
$commandHandler = new Dispatcher\Swagger\DefaultCommandRegisterer();
$swaggerConfigParser = Dispatcher\Swagger\ParserFactory::parserFor($swaggerFile);
$swaggerConfig = $swaggerConfigParser->parse($swaggerFile);
\Dispatcher\Swagger\SwaggerDispatcher::InjectRoutesFromConfig($app, $swaggerConfig);

$app->run();
