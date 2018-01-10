<?php

namespace Model\Item\Calculation;

use Model\Item\ItemInterface;

interface CalculationStrategy {
    public function calculate(ItemInterface $item, Int $money): Int;
}