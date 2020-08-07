<?php

require_once dirname(__DIR__) . '/Model/Voucher.php';

class VoucherFactory
{
    private static function create(string $name, float $amount, ?int $usageLimit): Voucher
    {
        return (new Voucher())
            ->setName($name)
            ->setAmount((int)($amount))
            ->setUsageLimit($usageLimit);
    }

    public static function createFixedCart(string $name, float $amount, ?int $usageLimit = null): Voucher
    {
        return (self::create($name, $amount * 100, $usageLimit))
            ->setType(Voucher::TYPE_CART)
            ->setAmountType(Voucher::AMOUNT_FIXED);
    }

    public static function createFixedUnit(string $name, float $amount, ?int $usageLimit = null): Voucher
    {
        return (self::create($name, $amount * 100, $usageLimit))
            ->setType(Voucher::TYPE_UNIT)
            ->setAmountType(Voucher::AMOUNT_FIXED);
    }

    public static function createPercentCart(string $name, float $amount, ?int $usageLimit = null): Voucher
    {
        return (self::create($name, $amount, $usageLimit))
            ->setType(Voucher::TYPE_CART)
            ->setAmountType(Voucher::AMOUNT_PERCENT);
    }

    public static function createPercentUnit(string $name, float $amount, ?int $usageLimit = null): Voucher
    {
        return (self::create($name, $amount, $usageLimit))
            ->setType(Voucher::TYPE_UNIT)
            ->setAmountType(Voucher::AMOUNT_PERCENT);
    }
}