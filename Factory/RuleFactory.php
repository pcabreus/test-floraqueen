<?php

require_once dirname(__DIR__) . '/Model/Rule.php';
require_once dirname(__DIR__) . '/Model/Type.php';

class RuleFactory
{
    public static function create(
        ?Type $type,
        ?float $cartAmount = null,
        $cartQuantity = null,
        ?float $itemAmount = null,
        $itemQuantity = null
    ) {
        return (new Rule())
            ->setCartAmount((int)($cartAmount * 100))
            ->setCartQuantity($cartQuantity)
            ->setItemAmount($itemAmount)
            ->setItemQuantity($itemQuantity)
            ->setProductType($type);
    }
}