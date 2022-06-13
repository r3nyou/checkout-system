We sell only three products:

```
Product code | Name         | Price
--------------------------------------
FR1          | Fruit tea    | £3.11
SR1          | Strawberries | £5.00
CF1          | Coffee       | £11.23   

```

- The CEO is a big fan of buy-one-get-one-free offers and of fruit tea.
- The COO likes low prices and wants people buying strawberries to get a price discount for bulk purchases. If you buy 3 or more strawberries, the price should drop to £4.50
- Our check-out can scan items in any order
- It needs to be flexible regarding our pricing rules

The interface to our checkout looks like this (shown in PHP):
```php
$co = new Checkout($pricingRules);
$co->scan($item);
$co->scan($item);
$price = $co->total;
```

Test data:

Basket: FR1,SR1,FR1,FR1,CF1  
Total price expected: £22.45

Basket: FR1,FR1  
Total price expected: £3.11

Basket: SR1,SR1,FR1,SR1  
Total price expected: £16.61

---
```
./vendor/bin/phpunit --testsuite checkout
```
