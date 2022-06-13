<?php

namespace Test\Checkout;

use PHPUnit\Framework\TestCase;
use Supermarket\Checkout;
use Supermarket\Item;
use Supermarket\PriceRules\BulkDiscount;
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

    public function testShouldDiscountForBulk()
    {
        $pricingRules = [
            'SR1' => BulkDiscount::class,
        ];
        $co = new Checkout($pricingRules);
        $co->scan(new Item('SR1', 5.00));
        $co->scan(new Item('SR1', 5.00));
        $co->scan(new Item('SR1', 5.00));

        $this->assertSame(13.50, $co->total());
    }

    public function testMultiItemExample1()
    {
        $pricingRules = [
            'FR1' => BuyOneGetOneFree::class,
            'SR1' => BulkDiscount::class,
        ];
        $co = new Checkout($pricingRules);
        $co->scan(new Item('FR1', 3.11));
        $co->scan(new Item('SR1', 5.00));
        $co->scan(new Item('FR1', 3.11));
        $co->scan(new Item('FR1', 3.11));
        $co->scan(new Item('CF1', 11.23));

        $this->assertSame(22.45, $co->total());
    }

    public function testMultiItemExample2()
    {
        $pricingRules = [
            'FR1' => BuyOneGetOneFree::class,
            'SR1' => BulkDiscount::class,
        ];
        $co = new Checkout($pricingRules);
        $co->scan(new Item('SR1', 5.00));
        $co->scan(new Item('SR1', 5.00));
        $co->scan(new Item('FR1', 3.11));
        $co->scan(new Item('SR1', 5.00));

        $this->assertSame(16.61, $co->total());
    }
}