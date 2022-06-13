<?php

namespace Supermarket;

class Checkout
{
    private array $items;

    private array $pricingRules;

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
        $this->setupPricingRule();

        $total = 0;
        foreach ($this->items as $item) {
            $total += $item->pricingRule->getActPrice($item->price, $item->qty);
        }

        return $total;
    }

    protected function setupPricingRule(): void
    {
        foreach ($this->pricingRules as $id => $pricingRule) {
            if (array_key_exists($id, $this->items)) {
                $this->items[$id]->pricingRule = new $pricingRule;
            }
        }
    }
}