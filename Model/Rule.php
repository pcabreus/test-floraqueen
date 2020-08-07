<?php

require_once 'Type.php';

class Rule
{
    private ?int $cartQuantity = null;
    private ?int $cartAmount = null;
    private ?int $itemQuantity = null;
    private ?int $itemAmount = null;
    private ?Type $productType = null;

    public function getCartQuantity(): ?int
    {
        return $this->cartQuantity;
    }

    public function setCartQuantity(?int $cartQuantity): self
    {
        $this->cartQuantity = $cartQuantity;

        return $this;
    }

    public function getCartAmount(): ?int
    {
        return $this->cartAmount;
    }

    public function setCartAmount(?int $cartAmount): self
    {
        $this->cartAmount = $cartAmount;

        return $this;
    }

    public function getProductType(): ?Type
    {
        return $this->productType;
    }

    public function setProductType(?Type $productType): self
    {
        $this->productType = $productType;

        return $this;
    }

    public function getItemQuantity(): ?int
    {
        return $this->itemQuantity;
    }

    public function setItemQuantity(?int $itemQuantity): self
    {
        $this->itemQuantity = $itemQuantity;

        return $this;
    }

    public function getItemAmount(): ?int
    {
        return $this->itemAmount;
    }

    public function setItemAmount(?int $itemAmount): self
    {
        $this->itemAmount = $itemAmount;

        return $this;
    }
}