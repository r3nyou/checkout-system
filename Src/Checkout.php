<?php

namespace Supermarket;

class Checkout
{
    private $items;

    private $pricingRules;

    public function __construct(array $pricingRules = [])
    {
        $this->items = [];
        $this->pricingRules = $pricingRules;
    }

    public function scan(Item $item): void
    {
        if (!array_key_exists($item->id, $this->items)) {
            $this->items[$item->id] = $item;
        }
        $this->items[$item->id]->qty++;
    }

    public function total(): float
    {
        foreach ($this->pricingRules as $id => $pricingRule) {
            if (array_key_exists($id, $this->items)) {
                $this->items[$id]->priceRule = new $pricingRule;
            }
        }

        $total = 0;
        foreach ($this->items as $item) {
            $total += $item->priceRule->getActPrice($item->price, $item->qty);
        }

        return $total;
    }
}