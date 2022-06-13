<?php

namespace Supermarket\PriceRules;

class BulkDiscount implements PriceRule
{
    public function getActPrice(float $price, int $qty): float
    {
        $discount = ($qty >= 3) ? 0.9 : 1;
        return ($price * $discount) * $qty;
    }
}