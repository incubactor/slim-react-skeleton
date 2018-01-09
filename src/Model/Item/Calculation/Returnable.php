<?php

namespace Model\Item\Calculation;

use Aura\Di\Exception;
use Model;
use Model\Item\ItemInterface;

/**
 * This strategy is applied on the top of the DefaultCalculation in order to apply also the
 * Returnable policy that consist on giving one more item to the user every X items.
 *
 */
class Returnable implements CalculationStrategy {
    private $emptyContainersNeeded;
    private $itemCalculationStrategy;
    
    public function __construct(CalculationStrategy $itemCalculationStrategy, $emptyContainersNeeded = 3) {
        $this->itemCalculationStrategy = $itemCalculationStrategy;
        $this->emptyContainersNeeded = $emptyContainersNeeded;
    }
    
    public function calculate(ItemInterface $item, Int $money): Int {
        $buyableItems = $this->itemCalculationStrategy->calculate($item, $money);
        $giftAfterReturning = intdiv($buyableItems, $this->emptyContainersNeeded);
 
        return $buyableItems + $giftAfterReturning;
    }
    
}
