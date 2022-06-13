<?php

namespace Supermarket;

class Item
{
    private $id;

    private $price;

    public function __construct(string $id, float $price)
    {
            $this->id = $id;
            $this->price = $price;
    }

    public function price(): float
    {
        return $this->price;
    }
}