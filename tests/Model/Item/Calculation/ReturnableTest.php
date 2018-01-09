<?php

use PHPUnit\Framework\TestCase;
use Model\Item\Calculation\DefaultCalculation;
use Model\Item\ItemFactory;
use Model\Item\Calculation\Returnable;
require 'tests/cliRoot.php';
class ReturnableTest extends TestCase {

    private $calculationStrategy;
    private $itemFactory;

    protected function setUp()
    {
        $buyStrategy = new DefaultCalculation();
        $this->calculationStrategy = new Returnable($buyStrategy);
        $this->itemFactory = new ItemFactory();
    }

    /**
     * The ReturnableStrategy differently from the DefaultCalculation Strategy, calculates how many
     * Items are buyable with some amount of money, considering that for every 3 items, the user get one new item
     * for free
     *
     *  @dataProvider itemsAndMoneyDataProvider
     */ 
    public function testItShouldConsidertheReturnedemptyPackages(
        $itemId,
        $itemName,
        $itemPricePerUnit,
        $availableMoney,
        $should
    ) {
        $item = $this->itemFactory->create($itemId, $itemName, $itemPricePerUnit);
        $this->assertEquals(
            $should,
            $this->calculationStrategy->calculate($item, $availableMoney)
        );
    }

    public function itemsAndMoneyDataProvider()
    {
        return [
            [1, 'Candies', 5, 5, 1],
            [1, 'Candies', 5, 10, 2],
            [1, 'Candies', 5, 25, 6],
            [1, 'Candies', 5, 40, 10],
            [1, 'Candies', 5, 0, 0],
        ];
    }

    /**
     *  @dataProvider invalidCasesDataProvider
     */ 
    public function testItShouldFailWithInvalidData(
        $itemId,
        $itemName,
        $itemPricePerUnit,
        $availableMoney,
        $expectedException
    ) {
        $item = $this->itemFactory->create($itemId, $itemName, $itemPricePerUnit);
        $this->expectException($expectedException);
        $this->calculationStrategy->calculate($item, $availableMoney);
    }

    public function invalidCasesDataProvider()
    {
        return [
            [1, 'Candies', 0, 5, 'DivisionByZeroError'],
            [1, 'Candies', 0, 0, 'DivisionByZeroError'],
        ];
    }
}
