<?php

namespace Module\Api\Controller\Auth;

//use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Lib\Controller\AbstractController;
//use Firebase\JWT\JWT;
use Psr\Http\Message\RequestInterface;

class PostToken extends AbstractController
{
    public function execute(RequestInterface $request, ResponseInterface $response, $params)
    {

	$data = [
            'success' => true,
            'message' => ''
        ];
        $httpStatusCode = 200;

        $postParams = $request->getParsedBody();

	/** @var \Model\Users $userModel */
        $userModel = $this->modelFactory->get('users');
        if ($user = $userModel->authenticate($postParams['credential'], $postParams['password'])) {
            $token = $this->jwtHelper->createToken(['user_id' => $user['id']]);
            $data['token'] = $token;
            $data['user'] = $user;
        } else {
            $httpStatusCode = 400;
            $data['success'] = false;
            $data['message'] = 'Invalid credential';
        }
        return $response->withJson($data, $httpStatusCode);
    }

}

