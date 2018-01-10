<?php
use Model\Item\ItemGateway;
use Model\Item\ItemFactory;

// DIC configuration

/** @var SlimAura\Container $di */
$di = $app->getContainer();

// -----------------------------------------------------------------------------
// Service providers
// -----------------------------------------------------------------------------

// view
$di->set('viewRenderer', function () use ($di) {
    $router = $di->get('router');
    return new Lib\View\Renderer($router);
});

// Set Callable Resolver
$di->set('callableResolver', new Lib\Di\CallableResolver($di));


// -----------------------------------------------------------------------------
// Service factories
// -----------------------------------------------------------------------------

// monolog
$di->set('loggerNameSetting', function () use ($di) {
    return $di->get('settings')['logger']['name'];
});

$di->params['Monolog\Logger']['name'] = $di->lazyGet('loggerNameSetting');

$di->set('logger', function () use ($di) {
    $settings = $di->get('settings')['logger'];
    $logger = $di->newInstance('Monolog\Logger');
    $logger->pushProcessor(new \Monolog\Processor\UidProcessor());
    $logger->pushHandler(new \Monolog\Handler\StreamHandler($settings['path'], \Monolog\Logger::DEBUG));

    return $logger;
});

// Db
$di->set('db', function () use ($di) {
    $settings = $di->get('settings')['pdo'];
    $pdo = new \PDO($settings['dns'], $settings['user'], $settings['password']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    return $pdo;
});

// Model
$di->params[Lib\Model\AbstractModel::class] = [
    'db'          => $di->lazyGet('db'),
    'slugHandler' => \Behat\Transliterator\Transliterator::class
];

$di->params['Model\ItemModel']['gateway'] = $di->lazyNew(ItemGateway::class);
$di->params['Model\ItemModel']['itemFactory'] = $di->lazyNew(ItemFactory::class);
$di->params[Lib\Model\ModelFactory::class] = [
    'map' => [
        'users'     => $di->newFactory('Model\Users'),
        'items' =>  $di->newFactory('Model\ItemModel'),
    ],
];

$di->set('modelFactory', $di->lazyNew('Lib\Model\ModelFactory'));

// JWT
$di->set('jwtHelper', function () use ($di) {
    $settings = $di->get('settings')['auth'];
    return new \Lib\Helper\JwtAuthentication($settings['jwtKey'], $settings['requestAttribute']);
});

$di->set('jwtMiddleware', function () use ($di, $app) {
    $settings = $di->get('settings')['auth'];
    $jwtAuthentication = new \Slim\Middleware\JwtAuthentication([
      "secret" => $settings['jwtKey'],
      "path" => $settings['path'],
      "passthrough" => $settings['passthrough'],
      "relaxed" => $settings['relaxed'],
      "error" => function($request, $response, $arguments) use ($di, $app) {
        $redirectUrl = $di->get('router')->pathFor('frontend.auth.registration');
        $redirectUrl = 'http://sampleapp.local/auth/registration';
        return $response->withRedirect($redirectUrl, 303);
      }
    ]);
    return $jwtAuthentication;
    //return new \Lib\Middleware\JwtIntercept($jwtAuthentication);

});
// -----------------------------------------------------------------------------
// Controller factories
// -----------------------------------------------------------------------------

$di->set('layoutSetting', function () use ($di) {
            
    return $di->get('settings')['view']['layoutPath'];
});

$di->params[Lib\Controller\AbstractController::class] = [
    'layoutPath'   => $di->lazyGet('layoutSetting'),
    'viewRenderer' => $di->lazyGet('viewRenderer'),
    'logger'       => $di->lazyGet('logger'),
    'modelFactory' => $di->lazyGet('modelFactory'),
    'jwtHelper'    => $di->lazyGet('jwtHelper'),
];


