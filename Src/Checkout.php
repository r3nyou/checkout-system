<?php

namespace Supermarket;

class Checkout
{
    private $total;

    public function scan(Item $item): void
    {
        $this->total += $item->price();
    }

    public function total(): float
    {
        return $this->total;
    }
}