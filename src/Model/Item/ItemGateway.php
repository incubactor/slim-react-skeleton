<?php

namespace Model\Item;

use Aura\Di\Exception;

/**
 * Its just a fake Gateway. There should be a connection to a database so to have
 * data driven item configs
 */
class ItemGateway {
    private $storageSimulation = [
        1 => [
            'id' => 1,
            'name' => 'Items',
            'pricePerUnit' => 5,
        ],
    ];

    public function getById(Int $id) {
        return $this->storageSimulation[$id];    
    }
    
}


