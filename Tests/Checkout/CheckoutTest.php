<?php

namespace Test\Checkout;

use PHPUnit\Framework\TestCase;
use Supermarket\Checkout;
use Supermarket\Item;
use Supermarket\PriceRules\BuyOneGetOneFree;

class CheckoutTest extends TestCase
{
    public function testShouldGetSingleItemPrice()
    {
        $item = new Item('FR1', 3.11);
        $co = new Checkout();
        $co->scan($item);
        $this->assertSame(3.11, $co->total());
    }
    
    public function testShouldGetMultiItemPrice()
    {
        $itemFR = new Item('FR1', 3.11);
        $itemSR = new Item('SR1', 5.00);
        $co = new Checkout();
        $co->scan($itemFR);
        $co->scan($itemSR);

        $this->assertSame(8.11, $co->total());
    }

    public function testShouldBuyOneGetOneFree()
    {
        $pricingRules = [
            'FR1' => BuyOneGetOneFree::class,
        ];
        $co = new Checkout($pricingRules);
        $co->scan(new Item('FR1', 3.11));
        $co->scan(new Item('FR1', 3.11));

        $this->assertSame(3.11, $co->total());
    }

    // TODO   price discount for bulk: SR1,SR1,SR1 13.5

//    public function testExample1()
//    {
//        $co = new Checkout($pricingRules);
//        $co->scan($itemFR);
//        $co->scan($itemSR);
//        $co->scan($itemFR);
//        $co->scan($itemFR);
//        $co->scan($itemCF);
//        $this->assertSame(22.45, $co->total());
//    }
}