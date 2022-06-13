<?php

namespace Supermarket\PriceRules;

class Normal implements PriceRule
{
    public function getActPrice(float $price, int $qty): float
    {
        return $price * $qty;
    }
}