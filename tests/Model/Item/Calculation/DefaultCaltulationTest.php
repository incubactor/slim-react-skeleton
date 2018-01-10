<?php

use PHPUnit\Framework\TestCase;
use Model\Item\Calculation\DefaultCalculation;
use Model\Item\ItemFactory;
require 'tests/cliRoot.php';
/**
   You have M money to buy candies that cost 5 each. Every 3 empty
   wrappers you bring back to the store you get one extra free candy piece. How many pieces of candy C will
   you eat?"
   ● How many candies C will you eat for M = 10?
   ● How many candies C will you eat for M = 25?
   ● How many candies C will you eat for M = 40?
**/
class StackTest extends TestCase {

    private $calculationStrategy;
    private $itemFactory;

    protected function setUp()
    {
        $this->calculationStrategy = new DefaultCalculation();
        $this->itemFactory = new ItemFactory();
    }

    /**
     *  This behaviour is checking the default calculation.
     *  It answer to the question: Every Item costs C, how many Items will I buy for M?
     *   Please consider we're not testing the "Returnable" strategy, which is adding also
     *  the free items got for returning the empty package.
     *  This is tested on the ReturnableTest
     *
     *  @dataProvider itemsAndMoneyDataProvider
     */ 
    public function testItShouldCalculateHowManyItemsICanBuy(
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
            [1, 'Candies', 5, 25, 5],
            [1, 'Candies', 5, 40, 8],
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
        //$this->setExpectedException('InvalidArgumentException');
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
