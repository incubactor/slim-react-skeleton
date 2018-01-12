<?php

namespace Module\Frontend\Controller\Auth;

use Lib\Controller\AbstractController;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class Login extends AbstractController
{
    public function execute(RequestInterface $request, ResponseInterface $response, $params)
    {
        /** @var  \Lib\View\Renderer $viewRenderer */
        $viewRenderer = $this->viewRenderer;
        $viewRenderer->setHeadTitle('Login');

	return $this->render($request, $response, $params);
    }

}
