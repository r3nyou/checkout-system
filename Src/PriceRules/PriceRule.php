<?php

namespace Supermarket\PriceRules;

interface PriceRule
{
    public function getActPrice(float $price, int $qty): float;
}