<?php

require_once dirname(__DIR__) . '/Model/Product.php';
require_once dirname(__DIR__) . '/Model/Type.php';

class ProductFactory
{
    public static function create(string $name, float $price, Type $type): Product
    {
        return (new Product())
            ->setName('Product ' . $name)
            ->setPrice((int)($price * 100))
            ->setType($type);
    }
}