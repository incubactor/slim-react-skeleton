<?php

namespace Model;

use Model\Item\ItemInterface;
use Aura\Di\Exception;
use Lib\Model\AbstractModel;
use Model\Item\ItemGateway;
use Model\Item\ItemCreator;

class ItemModel {
    private $gateway;
    private $itemFactory;
    
    public function __construct(ItemGateway $gateway, ItemCreator $itemFactory) {
        $this->gateway = $gateway;
        $this->itemFactory = $itemFactory;
    }
    
    public function getById(Int $id): ItemInterface {
        $rawItem =  $this->gateway->getById($id);
        return $this->itemFactory->create($rawItem['id'], $rawItem['name'], $rawItem['pricePerUnit']);
    }
}


