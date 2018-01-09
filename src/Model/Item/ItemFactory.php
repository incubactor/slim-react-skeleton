<?php

namespace Model\Item;

use Aura\Di\Exception;
use Model\Item;

class ItemFactory implements ItemCreator {
    public function create($id, $name, $pricePerUnit): ItemInterface {
        return new Item($id, $name, $pricePerUnit);
    }
    
}
