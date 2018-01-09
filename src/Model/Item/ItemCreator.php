<?php

namespace Model\Item;

use Aura\Di\Exception;

interface ItemCreator {
    public function create(Int $id, String $name, float $pricePerUnit): ItemInterface;
}
