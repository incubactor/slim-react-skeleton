<?php

namespace Module\Api\Controller\Auth;

use Lib\Controller\AbstractController;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class Logout extends AbstractController
{
    public function execute(RequestInterface $request, ResponseInterface $response, $params)
    
//    public function execute($params)
    {
        if (isset($params['user_id'])) {
            $userId = (int)$params['user_id'];
            /** @var \Model\Users $userModel */
            $usersModel = $this->modelFactory->get('users');
            $usersModel->logout($userId);
        }

        $httpStatusCode = 200;
        $data = [
            'success' => true,
            'message' => '',
        ];
        return $this->response->withJson($data, $httpStatusCode);
    }

}

