<?php

namespace Module\Frontend\Controller\Items;

use Lib\Controller\AbstractController;


class Index extends AbstractController
{

    public function init()
    {
        /** @var  \Lib\View\Renderer $viewRenderer */
        $viewRenderer = $this->viewRenderer;
        $viewRenderer->setHeadTitle('Candies');

    }

    public function execute($args)
    {
        $this->render();
    }

}
