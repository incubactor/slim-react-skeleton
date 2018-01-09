<?php

namespace Module\Api\Controller\Items;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Lib\Controller\AbstractController;
use Firebase\JWT\JWT;
use Model\Item\Calculation\DefaultCalculation;
use Model\Item\Calculation\Returnable;

class Calculate extends AbstractController
{
    
    public function execute($args)
    {
        $httpStatusCode = 200;
        $postParams = $this->request->getParsedBody();
        $token = $this->jwtHelper->getRequestAttribute();
        /** @var \Model\ItemModel $itemModel */
        if (isset($postParams['money']) && isset($postParams['itemId'])) {
            $itemModel = $this->modelFactory->get('items');
            
            $money = (int)$postParams['money'];
            $itemId = (int)$postParams['itemId'];
            $item = $itemModel->getById($itemId);
            //this could be injected of course, I just wanted to make the logic explicit
            $calculationStrategy = new DefaultCalculation();
            $returnableStrategy = new Returnable($calculationStrategy);
            $data = [
                'success' => true, 
                'message' => '', 
                'items' => $returnableStrategy->calculate($item, $money),
            ];
        } else {
            $data = [
                'success' => false,
                'message' => 'no right input data provided',
            ];
        }
        
        return $this->response->withJson($data, $httpStatusCode);
    }

}

