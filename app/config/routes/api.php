<?php
// Routes
// https://github.com/nikic/FastRoute

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->group('/api/v1', function () {

    $this->post('/auth', 'Module\Api\Controller\Auth\PostToken')->setName('api.auth.token');

    $this->delete('/auth/{user_id:\d+}', 'Module\Api\Controller\Auth\Logout')->setName('api.auth.logout');

    $this->post('/users', 'Module\Api\Controller\Users\Post')->setName('api.user.post');
    
    $this->post('/items', 'Module\Api\Controller\Items\Calculate')->setName('api.items.calculate');

});
