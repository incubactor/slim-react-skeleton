<?php

namespace Module\Api\Controller\Users;

use Lib\Controller\AbstractController;

class Get extends AbstractController
{

    public function execute($args)
    {
        $this->request->getAttribute('jwt'); // <= attribute injected by JwtIntercept Middleware
        /** @var \Model\Users $userModel */
        $userModel = $this->modelFactory->get('users');
        return $this->response->withJson(['success'=>true,'users' => $userModel->getById($args['id'])]);
    }

}

