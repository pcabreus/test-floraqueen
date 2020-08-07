<?php


class CartItem
{
    private string $code;
    private Product $product;
    private int $units = 0;

    public function __construct(Product $product)
    {
        $this->product = $product;
        $this->code = md5($product->getName() . time());
    }

    public function getTotals()
    {
        return $this->product->getPrice() * $this->units;
    }

    public function getUnitPrice()
    {
        return $this->product->getPrice();
    }

    public function getCode()
    {
        return $this->code;
    }

    public function addUnit($amount = 1)
    {
        $this->units += $amount;

        return $this;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function getUnits(): int
    {
        return $this->units;
    }

    public function setUnits(int $units): self
    {
        $this->units = $units;

        return $this;
    }
}