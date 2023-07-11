<?php

class Calculator
{
    protected const TAX_RATE = 15/100;

    public function calculatePriceWithDiscountsAndTax($products, $discounts): float
    {
        $total = 0;

        foreach ($products as $product) {
            if (in_array($product['productName'], array_column($discounts, 'productName'), true)) {
                foreach ($discounts as $discount) {
                    if ($discount['productName'] === $product['productName']) {
                        $discountedPrice = $product['productPrice'] * $discount['discount'] / 100;
                        $total += $product['productPrice'] - $discountedPrice + $discountedPrice * self::TAX_RATE;
                    }
                }
            } else {
                $total += $product['productPrice'] + $product['productPrice'] * self::TAX_RATE;
            }
        }

        return $total;
    }
}

$products = [
    [ 'productName' => 'Shirt', 'productPrice' => 50 ],
    [ 'productName' => 'Pants', 'productPrice' => 100 ],
    [ 'productName' => 'Shoes', 'productPrice' => 200 ]
];

$discounts = [
    [ 'productName' => 'Shirt', 'discount' => 20 ],
    [ 'productName' => 'Pants', 'discount' => 10 ],
];

$calculator = new Calculator();
echo $calculator->calculatePriceWithDiscountsAndTax($products, $discounts);






















