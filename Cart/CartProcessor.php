<?php

require_once 'Cart.php';
require_once dirname(__DIR__) . '/Model/Voucher.php';

class CartProcessor
{
    public function process(Cart $cart)
    {
        $total = $cart->getTotals();

        foreach ($cart->getVouchers() as $voucher) {
            $cartItems = $this->applyCartItemRules($voucher, $cart);
            $total -= $this->calculateDiscountUnit($voucher, $cartItems);
        }

        foreach ($cart->getCartVouchers() as $voucher) {
            if (null === $cart = $this->applyCartRules($voucher, $cart, $total)) {
                continue;
            }

            $total -= $this->calculateDiscountCart($voucher, $total);
        }


        return $total;
    }

    private function applyCartRules(Voucher $voucher, Cart $cart, $total): ?Cart
    {
        foreach ($voucher->getRules() as $rule) {
            if ($rule->getCartAmount() !== null && $rule->getCartAmount() > $total) {
                return null;
            }

            if ($rule->getCartQuantity() !== null && $rule->getCartQuantity() > $cart->getItemsCount()) {
                return null;
            }
        }

        return $cart;
    }

    private function applyCartItemRules(Voucher $voucher, Cart $cart): array
    {
        $items = [];
        foreach ($voucher->getRules() as $rule) {
            foreach ($cart->getItems() as $item) {
                if ($rule->getProductType() && !$rule->getProductType()->equals($item->getProduct()->getType())) {
                    continue;
                }

                if ($rule->getItemAmount() !== null && $rule->getItemAmount() > $cart->getTotals(
                        $rule->getProductType() ?? null
                    )) {
                    continue;
                }

                if ($rule->getItemQuantity() !== null && $rule->getItemQuantity() > $item->getUnits()) {
                    continue;
                }

                $items[] = $item;
            }
        }

        return $items;
    }

    private function calculateDiscountCart(Voucher $voucher, $total): int
    {
        if ($voucher->isPercent()) {
            return $this->calculatePercent($total, $voucher->getAmount());
        }

        return $voucher->getAmount();
    }

    /**
     * @return int
     * @var CartItem[] $items
     * @var Voucher $voucher
     */
    private function calculateDiscountUnit(Voucher $voucher, array $items): int
    {
        $amount = 0;
        foreach ($items as $item) {
            if ($voucher->isPercent()) {
                $base = $item->getUnitPrice();

                $amount += $this->calculatePercent($base, $voucher->getAmount());
            } else {
                $amount += $voucher->getAmount();
            }

            if (null === $voucher->getUsageLimit()) {
                $voucher->reduceUsageLimit();
                if (0 === $voucher->getUsageLimit()) {
                    break;
                }
            }
        }

        return $amount;
    }

    private function calculatePercent($base, $percent)
    {
        return $base * $percent / 100;
    }
}