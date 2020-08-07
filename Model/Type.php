<?php

class Type
{
    public const TYPES = ['A', 'B', 'C'];
    private string $name;

    public function __construct($name)
    {
        if (!in_array($name, self::TYPES)) {
            throw  new InvalidArgumentException(sprintf('%s is not a valid type', $name));
        }

        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function equals(Type $type)
    {
        return $this->name === $type->getName();
    }
}