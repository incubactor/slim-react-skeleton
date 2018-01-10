<?php

namespace Model\Item\Calculation;

use Aura\Di\Exception;
use Model\Item\ItemInterface;

/**
 * Implements the strategy to calculate how many items can be bought with some amount of money
 *
 */
class DefaultCalculation implements CalculationStrategy {
    public function calculate(ItemInterface $item, Int $money): Int {
        return intdiv($money, $item->pricePerUnit());
    }
}