<?php

namespace Lib\Controller;

use Slim\Views\PhpRenderer;
use Psr\Log\LoggerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Lib\Model\ModelFactory;
use Lib\Helper\JwtAuthentication;
use Psr\Http\Message\RequestInterface;
use Dispatcher\Swagger\CommandHandler;

abstract class AbstractController implements CommandHandler
{
    /**
     * Injected
     * @var PhpRenderer
     */
    protected $viewRenderer;

    /**
     * Injected
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @var ModelFactory
     */
    protected $modelFactory;

    /**
     * @var JwtAuthentication
     */
    protected $jwtHelper;

    protected $layout = 'layout.phtml';

    protected $layoutPath;

    private $renderLayout = true;

    public function __construct(
        PhpRenderer $viewRenderer,
        LoggerInterface $logger,
        $layoutPath = 'src/layout/',
        ModelFactory $modelFactory,
        JwtAuthentication $jwtHelper
    )
    {
        $this->viewRenderer = $viewRenderer;
        $this->logger = $logger;
        $this->layoutPath = $layoutPath;
        $this->modelFactory = $modelFactory;
        $this->jwtHelper = $jwtHelper;
    }

    protected function setLayout($layout)
    {
        $this->layout = $layout;
    }

    /**
     * Render Layout with embedded action response.
     *
     * @param string $viewTemplate
     * @return ResponseInterface
     */
    public function render(RequestInterface $request, ResponseInterface $response, $args, $viewTemplate = '')
    {
        //MAYBE the viewTemplate can be added to the args
        if (empty($viewTemplate)) {
            $viewTemplate = $this->_getTemplateViewPath();
        }
        if ($this->renderLayout && $this->layout) {
            // Render View
            $actionContent = $this->viewRenderer->fetch($viewTemplate);
            $viewAttributes = $this->viewRenderer->getAttributes();
            $viewAttributes['content'] = $actionContent;
            $this->viewRenderer->setAttributes($viewAttributes);
            // Render layout
            return $this->viewRenderer->render($response, $this->getLayoutFile());
        } else {
            return $this->viewRenderer->render($response, $viewTemplate);
        }
    }

    protected function getLayoutFile()
    {
        return $this->layoutPath . $this->layout;
    }

    protected function disableLayout()
    {
        $this->renderLayout = false;
    }

    protected function enableLayout()
    {
        $this->renderLayout = true;
    }

    private function _getTemplateViewPath()
    {
        $classInfo = new \ReflectionClass($this);
        $classPath = dirname($classInfo->getFileName());
        $explodePath = explode('/', $classPath);
        return $classPath . '/../../view/' . strtolower($explodePath[count($explodePath) - 1] . '/' . $classInfo->getShortName()) . '.phtml';
    }

}
