<?php
require __DIR__ . '/../vendor/autoload.php';

$settings = require __DIR__ . '/../app/config/settings.php';
$di = new SlimAura\Container($settings);
$app = new \Slim\App($di);
require __DIR__ . '/../app/config/dependencies.php';
require __DIR__ . '/../app/config/middleware.php';

$openApiFile = $di->get('settings')['routes']['path'];
$openApiConfigParser = \Dispatcher\OpenApi\ParserFactory::parserFor($openApiFile);
$openApiConfig = $openApiConfigParser->parse($openApiFile);
$applicationBridge = new \Sab\Application\Bridge\SlimBridge($app);
$routesInjector = new \Dispatcher\OpenApi\Route\DefaultRouteInjector();
$openApiDispatcher = new \Dispatcher\OpenApi\OpenApiDispatcher($routesInjector);
$openApiDispatcher->InjectRoutesFromConfig($applicationBridge, $openApiConfig);

$app->run();
