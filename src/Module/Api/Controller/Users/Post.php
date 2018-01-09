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
        $data['user'] = $userModel->register($postParams);

        return $this->response->withJson($data, $httpStatusCode);
    }

}

