<?php

namespace Module\Api\Controller\Users;

use Lib\Controller\AbstractController;

class GetList extends AbstractController
{

    public function execute($args)
    {
        /** @var \Model\Users $userModel */
        $usersModel = $this->modelFactory->get('users');
        return $this->response->withJson($userModel->getList());
    }

}

