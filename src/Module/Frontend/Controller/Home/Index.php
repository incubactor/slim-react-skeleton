<?php

namespace Module\Frontend\Controller\Home;

use Lib\Controller\AbstractController;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;


class Index extends AbstractController
{
    public function execute(RequestInterface $request, ResponseInterface $response, $params)
    {
        /** @var  \Lib\View\Renderer $viewRenderer */
        $viewRenderer = $this->viewRenderer;
        $viewRenderer->setHeadTitle('Home');
        $viewRenderer->appendStyleSheet('css/app.css');
        $viewRenderer->appendBodyScript('js/app.js');

	$this->logger->log(\Psr\Log\LogLevel::DEBUG, 'Home Index controller');
        return $this->render($request, $response, $params);
    }

}
