<?php

namespace Module\Api\Controller\Users;

use Lib\Controller\AbstractController;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class Post extends AbstractController
{
    public function execute(RequestInterface $request, ResponseInterface $response, $params)
    {
        $data = [
            'success' => true,
            'message' => ''
        ];
        $httpStatusCode = 200;

        /** @var \Model\Users $userModel */
        $userModel = $this->modelFactory->get('users');
        $postParams = $request->getParsedBody();
        $user = $userModel->register($postParams);
        $token = $this->jwtHelper->createToken(['user_id' => $user['id']]);
        $data['token'] = $token;
        $data['user'] = $user;
        
        return $response->withJson($data, $httpStatusCode);
    }

}

