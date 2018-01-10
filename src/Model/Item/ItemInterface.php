<?php

namespace Model\Item;

use Aura\Di\Exception;

interface ItemInterface {
    public function name(): String;
    public function pricePerUnit(): Float;
    public function id(): Int;
}
