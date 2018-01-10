<?php

namespace Module\Api\Controller\Auth;

use Lib\Controller\AbstractController;

class Logout extends AbstractController
{

    public function execute($args)
    {
        if (isset($args['user_id'])) {
            $userId = (int)$args['user_id'];
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

