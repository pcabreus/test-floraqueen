<?php

require_once dirname(__DIR__) . '/Cart/Cart.php';
require_once dirname(__DIR__) . '/Cart/CartItem.php';
require_once dirname(__DIR__) . '/Model/Product.php';

class CartFactory
{
    public static function createCart()
    {
        return new Cart();
    }

    public static function createCartItem(Product $product, $count = 1)
    {
        return (new CartItem($product))
            ->setUnits($count);
    }
}