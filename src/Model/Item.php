<?php

namespace Model;

use Model\Item\ItemInterface;
use Aura\Di\Exception;
use Lib\Model\AbstractModel;

class Item implements ItemInterface {
    private $id;
    private $itemName;
    private $pricePerUnit;

    public function __construct(Int $id, String $itemName, Int $pricePerUnit) {
        $this->id = $id;
        $this->itemName = $itemName;
        $this->pricePerUnit = $pricePerUnit;
    }
    
    public function id(): Int {
        return $this->id;
    }
    public function name(): String {
        return $this->itemName;
    }
    
    public function pricePerUnit(): Float {
        return $this->pricePerUnit;
    }
}


