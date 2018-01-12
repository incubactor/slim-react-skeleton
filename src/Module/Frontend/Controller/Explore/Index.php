<?php

namespace Module\Frontend\Controller\Explore;

use Lib\Controller\AbstractController;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;


class Index extends AbstractController
{

    public function execute(RequestInterface $request, ResponseInterface $response, $params)
    {
        /** @var  \Lib\View\Renderer $viewRenderer */
        $viewRenderer = $this->viewRenderer;
        $viewRenderer->setHeadTitle('Explore');
        $this->logger->log(\Psr\Log\LogLevel::DEBUG, 'Explore Index controller');
        return $this->render($request, $response, $params);
    }

}
