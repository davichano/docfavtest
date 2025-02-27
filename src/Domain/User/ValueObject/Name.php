<?php

namespace Domain\User\ValueObject;

use InvalidArgumentException;

class Name
{
    private string $value;

    public function __construct(string $value)
    {
        if (strlen($value) < 3 || strlen($value) > 50) {
            throw new InvalidArgumentException("The name must be between 3 and 50 characters.");
        }
        $this->value = $value;
    }

    public function __toString(): string
    {
        return $this->value;
    }

    public function value(): string
    {
        return $this->value;
    }
}