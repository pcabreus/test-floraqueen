<?php

require './Factory/ProductFactory.php';
require './Factory/VoucherFactory.php';
require './Factory/RuleFactory.php';
require './Factory/CartFactory.php';
require './Processor/CartProcessor.php';

function write($output)
{
    echo $output . " \n";
}

$productA = ProductFactory::create('A', 10, new Type('A'));
$productB = ProductFactory::create('B', 8, new Type('B'));
$productC = ProductFactory::create('C', 12, new Type('C'));

write($productA->getName());
write($productB->getName());
write($productC->getName());

$voucherV = (VoucherFactory::createPercentUnit(
    '10% off discount voucher for the second unit applying only to Product A',
    10,
    1
))
    ->addRule(RuleFactory::create(new Type('A'), null, null, null, 2));

$voucherR = (VoucherFactory::createFixedUnit(
    '5€ off discount on product type B',
    5
))
    ->addRule(RuleFactory::create(new Type('B'), null, null));

$voucherS = (VoucherFactory::createPercentCart(
    '5% discount on a cart value over 40€',
    5
))
    ->addRule(RuleFactory::create(null, 40, null));

write($voucherV->getName());
write($voucherS->getName());
write($voucherR->getName());

write("******");
$cart = CartFactory::createCart();

$cart
    ->addItem(CartFactory::createCartItem($productA, 2))
    ->addItem(CartFactory::createCartItem($productC))
    ->addVoucher($voucherS)
    ->addVoucher($voucherV)
    ->addItem(CartFactory::createCartItem($productB));

$processor = new CartProcessor();

if (3900 !== $example1 = $processor->process($cart)) {
    throw new \Exception(sprintf("Something is wrong, should be 3900 but the result is %s", $example1));
}


write(sprintf('Total cart value: %s€', $example1 / 100));


$cart = CartFactory::createCart();

$cart
    ->addItem(CartFactory::createCartItem($productA, 2))
    ->addVoucher($voucherS)
    ->addVoucher($voucherV)
    ->addItem(CartFactory::createCartItem($productB))
    ->addVoucher($voucherR)
    ->addItem(CartFactory::createCartItem($productC, 3));

if (5510 !== $example2 = $processor->process($cart)) {
    throw new \Exception(sprintf("Something is wrong, should be 5510 but the result is %s", $example2));
}

write(sprintf('Total cart value: %s€', $example2 / 100));
