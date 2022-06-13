<?php

namespace Supermarket\PriceRules;

class BuyOneGetOneFree implements PriceRule
{
    public function getActPrice(float $price, int $qty): float
    {
        return $price * round($qty / 2);
    }
}