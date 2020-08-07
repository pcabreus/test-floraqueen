<?php

require_once 'CartItem.php';

class Cart
{
    /** @var array|CartItem[] */
    private array $items = [];
    private array $vouchers = [];
    private array $cartVouchers = [];

    public function getTotals(Type $type = null)
    {
        $amount = 0;
        foreach ($this->items as $item) {
            if ($type !== null && !$type->equals($item->getProduct()->getType())) {
                continue;
            }

            $amount += $item->getTotals();
        }

        return $amount;
    }

    public function getItemsCount(Type $type = null)
    {
        $count = 0;
        foreach ($this->items as $item) {
            if ($type !== null && !$type->equals($item->getProduct()->getType())) {
                continue;
            }

            $count++;
        }

        return $count;
    }

    public function addItem(CartItem $cartItem): Cart
    {
        $this->items[$cartItem->getCode()] = $cartItem;

        return $this;
    }

    public function removeItem(CartItem $item): Cart
    {
        try {
            unset($this->items[$item->getCode()]);

            return $this;
        } catch (\Exception $e) {
            throw new InvalidArgumentException(sprintf('The product %s doesn\'t exist', $item->getCode()));
        }
    }

    public function addVoucher(Voucher $voucher): Cart
    {
        if ($voucher->isCartType()) {
            $this->cartVouchers[$voucher->getName()] = $voucher;
        } else {
            $this->vouchers[$voucher->getName()] = $voucher;
        }

        return $this;
    }

    public function removeVoucher(Voucher $voucher): Cart
    {
        try {

            if ($voucher->isCartType()) {
                unset($this->cartVouchers[$voucher->getName()]);
            } else {
                unset($this->vouchers[$voucher->getName()]);
            }

            return $this;
        } catch (\Exception $e) {
            throw new InvalidArgumentException(sprintf('The voucher %s doesn\'t exist', $voucher->getName()));
        }
    }

    /**
     * @return CartItem[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @return Voucher[]
     */
    public function getVouchers(): array
    {
        return $this->vouchers;
    }

    /**
     * @return Voucher[]
     */
    public function getCartVouchers(): array
    {
        return $this->cartVouchers;
    }
}