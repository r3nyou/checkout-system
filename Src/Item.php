<?php

namespace Supermarket;

use Supermarket\PriceRules\Normal;
use Supermarket\PriceRules\PriceRule;

class Item
{
    public string $id;

    public float $price;

    public int $qty;

    public PriceRule $pricingRule;

    public function __construct(string $id, float $price)
    {
        $this->id = $id;
        $this->price = $price;
        $this->qty = 0;
        $this->pricingRule = new Normal();
    }
}