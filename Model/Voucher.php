<?php

require_once 'Rule.php';

class Voucher
{
    public const TYPE_CART = 'cart';
    public const TYPE_UNIT = 'unit';

    public const AMOUNT_FIXED = 'fixed';
    public const AMOUNT_PERCENT = 'percent';
    private string $name;
    private string $type;
    private string $amountType;
    private ?int $usageLimit = null;
    private int $amount = 0;
    private array $rules = [];

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function reduceUsageLimit()
    {
        $this->usageLimit -= 1;
    }

    public function getUsageLimit(): ?int
    {
        return $this->usageLimit;
    }

    public function setUsageLimit(?int $usageLimit): self
    {
        $this->usageLimit = $usageLimit;

        return $this;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    /** @return Rule[] */
    public function getRules(): array
    {
        return $this->rules;
    }

    public function setRules(array $rules): self
    {
        $this->rules = $rules;

        return $this;
    }

    public function addRule(Rule $rule)
    {
        $this->rules[] = $rule;

        return $this;
    }

    public function isPercent()
    {
        return $this->amountType === self::AMOUNT_PERCENT;
    }

    public function isCartType()
    {
        return $this->type === self::TYPE_CART;
    }

    public function getAmountType(): string
    {
        return $this->amountType;
    }

    public function setAmountType(string $amountType): self
    {
        $this->amountType = $amountType;

        return $this;
    }
}