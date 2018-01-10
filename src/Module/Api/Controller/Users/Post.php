<?php

namespace Module\Api\Controller\Users;

use Lib\Controller\AbstractController;

class Post extends AbstractController
{

    public function execute($args)
    {
        $data = [
            'success' => true,
            'message' => ''
        ];
        $httpStatusCode = 200;

        /** @var \Model\Users $userModel */
        $userModel = $this->modelFactory->get('users');
        $postParams = $this->request->getParsedBody();
        $user = $userModel->register($postParams);
        $token = $this->jwtHelper->createToken(['user_id' => $user['id']]);
        $data['token'] = $token;
        $data['user'] = $user;
        
        return $this->response->withJson($data, $httpStatusCode);
    }

}

